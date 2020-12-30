<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Degree;
use App\Models\Graduate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GraduateController extends Controller
{
    function __construct()
    {
        $this->middleware('auth')->only(['destroy']);
    }

    function index(Request $request)
    {
        $graduates = Graduate::orderBy('id')->where('published', '=', true)->paginate(24);
        return view('portal.graduate.index', ['graduates' => $graduates]);
    }

    function index_career(Request $request, Career $career)
    {
        $graduates = $career->graduates()->where('published', '=', true)->paginate(24);
        return view('portal.graduate.career', ['career' => $career, 'graduates' => $graduates]);
    }



    function destroy(Graduate $graduate)
    {
        $user = Auth::user();
        if (($user->can('graduates.delete') || $user->id == $graduate->person->user_id)) {
            $success = $graduate->delete();

            if ($success) {
                return redirect()->back()->with("message", "Se ha borrado correctamente.")
                    ->with("type", "success");
            }

            return redirect()->back()->withInput()->with("message", "Algo ha salido mal, vuelva a intentar mas tarde.")
                ->with("type", "error");
        }
        abort(403, 'No autorizado para realizar esta accion.');
    }
}
