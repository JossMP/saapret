<?php

namespace App\Http\Controllers;

use App\Models\Professional;
use Illuminate\Http\Request;

class ProfessionalController extends Controller
{
    function index(Request $request)
    {
        $professionals = Professional::Paginate(10);
        return view('portal.professionals', ['professionals' => $professionals]);
    }
}
