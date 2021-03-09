<?php

namespace App\Http\Controllers;

use App\Models\Graduate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanelController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    function index(Request $request)
    {
        $user = Auth::user();
        if ($user->can('edit articles')) {
            abort(404);
        }
        $graduates = Graduate::paginate(50);
        return view('panel.index', ['graduates' => $graduates]);
    }
}
