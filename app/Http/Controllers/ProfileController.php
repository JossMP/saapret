<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.profile');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required',
            'password' => 'confirmed',
            'avatar'   => 'max:10240|mimes:png,jpeg',
        ], [
            'name.required'      => 'Nombre es requerido',
            'password.confirmed' => 'Las contraseñas no son iguales',
            'avatar.mimes'       => 'Solo se permite archivos jpg o png',
            'avatar.max'         => 'El archivo excede los 10mb',
        ]);

        if ($data['password'] !== null) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        if (!empty($request->file('avatar'))) {
            $filename = Str::random(5) . '.' . Auth::user()->id;
            $path = $request->file('avatar')->move(public_path('images/avatars'), $filename);
            if ($path) {
                $data["avatar"] = $filename;
                if (Auth::user()->avatar != 'default.png') {
                    @unlink(public_path('images/avatars/' . Auth::user()->avatar));
                }
            }
        }

        if (Auth::user()->update($data)) {
            return redirect()->back()->with("alert", ["message" => "Se han actualizado sus datos", "type" => "success"]);
        }
        return redirect()->back()->with("alert", ["message" => "Algo ha salido mal, vuelva a intentar mas tarde.", "type" => "danger"])->withInput();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
