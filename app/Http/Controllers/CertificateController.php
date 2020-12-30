<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    function __construct()
    {
        $this->middleware('auth')->only(['destroy']);
    }

    function destroy(Certificate $certificate)
    {
        $user = Auth::user();
        if (($user->can('certificates.delete') || $user->id == $certificate->person->user_id)) {
            $success = $certificate->delete();

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
