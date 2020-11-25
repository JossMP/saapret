<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortalController extends Controller
{
    function home()
    {
        return view('portal.home');
    }

    function faq()
    {
        return view('portal.faq');
    }
    function terms()
    {
        return view('portal.terms');
    }
    function policy()
    {
        return view('portal.privacy-policy');
    }
}
