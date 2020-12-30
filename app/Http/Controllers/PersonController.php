<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Certificate;
use App\Models\Degree;
use App\Models\Experience;
use App\Models\Graduate;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Traits\UploadTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PersonController extends Controller
{
    use UploadTrait;

    function __construct()
    {
        $this->middleware('auth')->except(['show']); //only(['edit', 'graduate_create', 'update', 'graduate_store']);
    }

    function graduate_create(Person $person)
    {
        $user = Auth::user();
        if (($user->can('graduates.create') || $user->id == $person->user_id)) {
            $careers = Career::all();
            $degrees = Degree::all();
            return view('portal.person.graduate', ['person' => $person, 'careers' => $careers, 'degrees' => $degrees]);
        }
        abort(403, 'No autorizado para realizar esta accion.');
    }

    function graduate_store(Request $request, Person $person)
    {
        $data = $request->validate([
            'career_id'   => 'required',
            'start_year'  => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'end_year'    => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 10),
            'title'       => 'required',
            'mention'     => '',
            'title_num'   => 'required',
            'date_issued' => 'required|date',
            'degree_id'   => '',
            //'file'        => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        if (($user->can('graduates.create') || $user->id == $person->user_id)) {
            $data['person_id'] = $person->id;
            $success = Graduate::create($data);
            if ($success) {
                return redirect()->route('portal.person.show', $person)->with("message", "Se ha añadido el titulo/grado corectamente.")
                    ->with("type", "success");
            }

            return redirect()->back()->withInput()->with("message", "Algo ha salido mal, vuelva a intentar mas tarde.")
                ->with("type", "error");
        }
        abort(403, 'No autorizado para realizar esta accion.');
    }

    function experience_create(Person $person)
    {
        $user = Auth::user();
        if (($user->can('experiences.create') || $user->id == $person->user_id)) {
            return view('portal.person.experience', ['person' => $person]);
        }
        abort(403, 'No autorizado para realizar esta accion.');
    }

    function experience_store(Request $request, Person $person)
    {
        $data = $request->validate([
            'institution' => 'required',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
            'position'    => 'required',
            'task'        => '',
            //'file'        => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        if (($user->can('experiences.create') || $user->id == $person->user_id)) {
            $data['person_id'] = $person->id;
            $success = Experience::create($data);
            if ($success) {
                return redirect()->route('portal.person.show', $person)->with("message", "Se ha añadido la experiencia laboral corectamente.")
                    ->with("type", "success");
            }

            return redirect()->back()->withInput()->with("message", "Algo ha salido mal, vuelva a intentar mas tarde.")
                ->with("type", "error");
        }
        abort(403, 'No autorizado para realizar esta accion.');
    }

    function certificate_create(Person $person)
    {
        $user = Auth::user();
        if (($user->can('certificates.create') || $user->id == $person->user_id)) {
            return view('portal.person.certificate', ['person' => $person]);
        }
        abort(403, 'No autorizado para realizar esta accion.');
    }
    function certificate_store(Request $request, Person $person)
    {
        $data = $request->validate([
            'mention'    => 'required',
            'organizer'  => 'required',
            'place'      => 'required',
            'hours'      => 'integer',
            'start_date' => 'required|date',
            'end_date'   => 'nullable|after_or_equal:start_date',
        ]);

        $user = Auth::user();
        if (($user->can('certificates.create') || $user->id == $person->user_id)) {
            $data['person_id'] = $person->id;
            $success = Certificate::create($data);
            if ($success) {
                return redirect()->route('portal.person.show', $person)->with("message", "Se ha añadido el Certificado/Curso corectamente.")
                    ->with("type", "success");
            }

            return redirect()->back()->withInput()->with("message", "Algo ha salido mal, vuelva a intentar mas tarde.")
                ->with("type", "error");
        }
        abort(403, 'No autorizado para realizar esta accion.');
    }

    function show(Person $person)
    {
        return view('portal.person.show', ['person' => $person]);
    }

    function edit(Person $person)
    {
        $user = Auth::user();
        if (($user->can('people.create') || $user->id == $person->user_id))
            return view('portal.person.edit', ['person' => $person]);
        abort(403, 'No autorizado para realizar esta accion.');
    }

    function update(Request $request, Person $person)
    {
        $user = Auth::user();
        if (($user->can('people.create') || $user->id == $person->user_id)) {
            $data = $request->validate([
                'name'           => 'required',
                'last_name'      => 'required',
                'address'        => 'required',
                'location_home'  => 'required',
                'location_birth' => 'required',
                'birthday'       => 'required|date',
                'doc_type'       => 'required',
                'doc_num'        => 'required',
                'phone'          => 'required',
                'email'          => 'required|email',
                'photo'          => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $last_photo = $person->getRawOriginal('photo');
            $data['slug'] = Str::slug($data['name'] . '_' . $data['last_name'] . '_' . $data['doc_num']);

            if ($request->has('photo')) {
                $image = $request->file('photo');

                $name     = Str::slug($data['slug']) . '_' . time() . '.' . $image->getClientOriginalExtension();
                $folder   = '/photos/';

                //$filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                $this->uploadOne($image, $folder, 'public', $name, $last_photo);
                $data['photo'] = $name;
            }

            $success = $person->update($data);

            if ($success) {
                return redirect()->route('portal.person.show', $person)->with("message", "Se ha guardado correctamente.")
                    ->with("type", "success");
            }

            return redirect()->route('portal.person.edit', $person)->withInput()->with("message", "Algo ha salido mal, vuelva a intentar mas tarde.")
                ->with("type", "error");
        }
        abort(403, 'No autorizado para realizar esta accion.');
    }
}
