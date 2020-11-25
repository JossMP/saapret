<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfessionController extends Controller
{
    function index()
    {
        return view('portal.search');
    }
}
