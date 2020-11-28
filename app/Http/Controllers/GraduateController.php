<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Graduate;
use Illuminate\Http\Request;

class GraduateController extends Controller
{
    function index(Request $request)
    {
        $graduates = Graduate::orderBy('id')->paginate(12);
        return view('portal.graduates.index', ['graduates' => $graduates]);
    }

    function index_career(Request $request, Career $career)
    {
        $graduates = $career->graduates()->paginate(12);
        return view('portal.graduates.career', ['career' => $career, 'graduates' => $graduates]);
    }
}
