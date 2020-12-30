<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Degree;
use App\Models\Graduate;
use Illuminate\Http\Request;

class GraduateController extends Controller
{
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
    function create()
    {
        return "FORM CREATE HERE";
    }
    function destroy(Graduate $graduate)
    {
        $success = $graduate->delete();

        if ($success) {
            return redirect()->back()->with("message", "Se ha borrado correctamente.")
                ->with("type", "success");
        }

        return redirect()->back()->withInput()->with("message", "Algo ha salido mal, vuelva a intentar mas tarde.")
            ->with("type", "error");
    }
}
