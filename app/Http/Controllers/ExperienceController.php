<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    function __construct()
    {
        $this->middleware('auth')->only(['destroy']);
    }

    function destroy(Experience $experience)
    {
        $user = Auth::user();
        if (($user->can('experiences.delete') || $user->id == $experience->person->user_id)) {
            $success = $experience->delete();

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
