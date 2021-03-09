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
use Illuminate\Support\Facades\Validator;

class PersonController extends Controller
{
    use UploadTrait;

    function __construct()
    {
        $this->middleware('auth')->except(['reniec', 'show', 'index', 'store']); //only(['edit', 'graduate_create', 'update', 'graduate_store']);
    }

    function reniec(Request $request)
    {
        // AQUI CODIGO DE USO DE API
        sleep(1);
        //return response()->json([]);
        return response()->json([
            'name'             => 'JOSUE',
            'first_last_name'  => 'MAZCO',
            'second_last_name' => 'PUMA',
            'address'          => 'Pje. Las Flores S/N',
            'birthday'         => '22-05-1987',
            'gender'           => 'MASCULINO',
            'marital_status'   => 'SOLTERO',
            'marital_status'   => 'SOLTERO',
        ]);
    }

    function index(Request $request)
    {
        return view('portal.person.register');
    }
    function store(Request $request)
    {
        $data = $request->validate(
            [
                'name'             => 'required',
                'first_last_name'  => 'required',
                'second_last_name' => 'required',
                'gender'           => 'required',
                'marital_status'   => 'required',
                'address'          => 'required',
                'location_home'    => 'required',
                'location_birth'   => 'required',
                'birthday'         => 'required|date',
                'doc_type'         => 'required',
                'doc_num'          => 'required|unique:people,doc_num,null,null,doc_type,' . $request->get('doc_type'),
                'phone'            => 'required',
                'email'            => 'required|email|unique:users,email',
                'username'         => 'required|unique:users,username',
                'photo'            => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'password'         => 'required|confirmed',
            ],
            [
                'name.required'             => 'Nombres es requerido',
                'first_last_name.required'  => 'Primer apellido es requerido',
                'second_last_name.required' => 'Segundo apellido es requerido',
                'gender.required'           => 'Este campo es requerido',
                'marital_status.required'   => 'Este campo es requerido',
                'address.required'          => 'Direccion es requerida',
                'location_home.required'    => 'Ubigeo de direccion es requerido',
                'location_birth.required'   => 'Ubigeo de Nacimiento es requerido',
                'birthday.required'         => 'Fecha de cumpleaño es requerido',
                'birthday.date'             => 'Fecha no valida',
                'doc_type.required'         => 'Tipo de documento requerido',
                'doc_num.required'          => 'Numero de documento es requerido',
                'doc_num.unique'            => 'Otro usuario ya esta usando este documento',
                'phone.required'            => 'Telefono requerido',
                'email.required'            => 'Email es requerido',
                'email.email'               => 'Email no valido',
                'email.unique'              => 'Este e-mail ya esta en uso',
                'username.required'         => 'Usuario requerido',
                'username.unique'           => 'Este usuario ya esta en uso',
                'photo.image'               => 'Imagen no valida',
                'photo.mimes'               => 'Formato no valida (png, jpg, gif)',
                'photo.max'                 => 'Tamaño maximo 2mb',
                'password.required'         => 'La contraseña es requerida',
                'password.confirmed'        => 'La contaseña no coincide',
            ]
        );

        $data_user = [
            'email'     => $request->email,
            'password'  => $request->password,
            'username'  => $request->email,
            'name'      => $request->name,
            'last_name' => $request->first_last_name . ' ' . $request->second_last_name,
        ];
        /*
        $person = Person::where('doc_type', $request->doc_type)->where('doc_num', $request->doc_num)->get();
        if ($person->count() > 0) {
            $validate->errors()->add('doc_num', 'Documento ya existe');
            return redirect()->back()->withInput()->with("message", "Ya existe una persona con ese numero de documento")
                ->with("type", "error")->withErrors($validate->errors());
        }*/

        return redirect()->back()->withInput()->with("message", "Se ha registrado los datos correctamente")
            ->with("type", "success");
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
            $data = $request->validate(
                [
                    'name'             => 'required',
                    'first_last_name'  => 'required',
                    'second_last_name' => 'required',
                    'gender'           => 'required',
                    'address'          => 'required',
                    'location_home'    => 'required',
                    'location_birth'   => 'required',
                    'birthday'         => 'required|date',
                    'doc_type'         => 'required',
                    'doc_num'          => 'required|unique:people,doc_num,null,id,doc_type,' . $request->get('doc_type'),
                    'phone'            => 'required',
                    'email'            => 'required|email|unique:users,email',
                    'username'         => 'required|unique:users,username',
                    'photo'            => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                    'password'         => 'required|confirmed',
                ],
                [
                    'name.required'             => 'Nombres es requerido',
                    'first_last_name.required'  => 'Primer apellido es requerido',
                    'second_last_name.required' => 'Segundo apellido es requerido',
                    'gender.required'           => 'Este campo es requerido',
                    'address.required'          => 'Direccion es requerida',
                    'location_home.required'    => 'Ubigeo de direccion es requerido',
                    'location_birth.required'   => 'Ubigeo de Nacimiento es requerido',
                    'birthday.required'         => 'Fecha de cumpleaño es requerido',
                    'birthday.date'             => 'Fecha no valida',
                    'doc_type.required'         => 'Tipo de documento requerido',
                    'doc_num.required'          => 'Numero de documento es requerido',
                    'doc_num.unique'            => 'Otro usuario ya esta usando este documento',
                    'phone.required'            => 'Telefono requerido',
                    'email.required'            => 'Email es requerido',
                    'email.email'               => 'Email no valido',
                    'email.unique'              => 'Este e-mail ya esta en uso',
                    'username.required'         => 'Usuario requerido',
                    'username.unique'           => 'Este usuario ya esta en uso',
                    'photo.image'               => 'Imagen no valida',
                    'photo.mimes'               => 'Formato no valida (png, jpg, gif)',
                    'photo.max'                 => 'Tamaño maximo 2mb',
                    'password.required'         => 'La contraseña es requerida',
                    'password.confirmed'        => 'La contaseña no coincide',
                ]
            );

            $last_photo = $person->getRawOriginal('photo');
            $data['slug'] = Str::slug($data['name'] . '_' . $data['first_last_name'] . '_' . $data['second_last_name'] . '_' . $data['doc_num']);

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
