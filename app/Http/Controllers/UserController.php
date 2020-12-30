<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    function __construct()
    {
        //$this->middleware(['permission:users-list']);
        //$this->middleware(['role:admin', 'permission:users-list']);
        //$this->middleware(['role:super-admin', 'permission:users-list']);
        $this->middleware(['role:super-admin|admin']);
    }
    function list(Request $request, User $user)
    {
        if ($user->hasRole('super-admin')) {
            $users = User::where('id', '!=', $user->id)->select();
        } else {
            $users = $user->users();
        }

        $queries = array();
        $columns = [
            'name',
            'email',
            'username',
        ];

        if ($request->has('filter') && in_array($request->filter, $columns)) {
            $filter = trim($request->filter);
            $order  = ($request->has('order') && $request->order == 'asc') ? 'asc' : 'desc';

            $users->orderBy($filter, $order);
            $queries['filter'] = $filter;
            $queries['order']  = $order;
        }
        return $users->paginate(10)->appends($queries);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $users = $this->list($request, $user);
        $order = ($request->has('order') && $request->order == 'asc') ? 'desc' : 'asc';
        $page  = ($request->has('page')) ? $request->page : '1';

        return view("users::index", ['current' => $user, 'users' => $users, 'order' => $order, 'page' => $page]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('name', '!=', 'super-admin')->get();
        return view('users::create', ['roles' => $roles]);
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
            'name'      => 'required',
            'last_name' => '',
            'email'     => 'required|email|unique:users,email',
            'username'  => 'required|min:3|unique:users,username',
            'password'  => 'required|confirmed',
            'avatar'    => 'max:10240|mimes:png,jpeg',
        ], [
            'name.required'      => 'Nombre es requerido',
            //'last_name.*'        => 'Apellido Requerido',

            'email.required'     => 'Nombre es requerido',
            'email.email'        => 'email no valido',
            'email.unique'       => 'El email ya esta siendo usado',

            'username.unique'    => 'El usuario ya esta siendo usado',
            'username.min'       => 'El usuario tiene que tener 3 caracteres como minimo',
            'username.*'         => 'El usuario es requerido',

            'password.required'  => 'La contraseña es requerida',
            'password.confirmed' => 'Las contraseñas no coinciden',

            'avatar.mimes'       => 'Solo se permite archivos jpg o png',
            'avatar.max'         => 'El archivo excede los 10mb',
            //'avatar.*'           => 'Se requiere una Imagen',
        ]);

        $data['password'] = Hash::make($data['password']);

        if (!empty($request->file('avatar'))) {
            $filename = Str::random(60) . '.new';
            $path = $request->file('avatar')->move(public_path('images/avatars'), $filename);
            if ($path) {
                $data["avatar"] = $filename;
            }
        }

        $user = User::create($data);

        if ($user) {
            $super = [];
            if ($request->has('is_super')) {
                $super[] = 'super-admin';
            }

            if ($request->has('roles')) {
                $user->syncRoles(array_merge($super, $request->roles));
            }
            return redirect()->back()->with("alert", ["message" => "Se han registrado los datos", "type" => "success"]);
        }
        return redirect()->back()->with("alert", ["message" => "Algo ha salido mal, vuelva a intentar mas tarde.", "type" => "danger"])->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::where('name', '!=', 'super-admin')->get();
        return view('users::edit', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'      => 'required',
            'last_name' => '',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            //'username'  => 'required|min:3|unique:users,username,' . $user->id,
            'password'  => 'confirmed',
            'avatar'    => 'max:10240|mimes:png,jpeg',
        ], [
            'name.required'      => 'Nombre es requerido',

            'email.required'     => 'Nombre es requerido',
            'email.email'        => 'email no valido',
            'email.unique'       => 'El email ya esta siendo usado',

            //'username.unique'    => 'El usuario ya esta siendo usado',
            //'username.min'       => 'El usuario tiene que tener 3 caracteres como minimo',
            //'username.*'         => 'El usuario es requerido',

            'password.required'  => 'La contraseña es requerida',
            'password.confirmed' => 'Las contraseñas no coinciden',

            'avatar.mimes'       => 'Solo se permite archivos jpg o png',
            'avatar.max'         => 'El archivo excede los 10mb',
        ]);

        if ($data['password'] !== null) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        if (!empty($request->file('avatar'))) {
            $filename = Str::random(60) . '.' . $user->id;
            $path = $request->file('avatar')->move(public_path('images/avatars'), $filename);
            if ($path) {
                $data["avatar"] = $filename;
                if ($user->avatar != 'default.png') {
                    @unlink(public_path('images/avatars/' . $user->avatar));
                }
            }
        }

        $super = [];
        if ($request->has('is_super')) {
            $super[] = 'super-admin';
        }

        if ($request->has('roles')) {
            $user->syncRoles(array_merge($super, $request->roles));
        }

        if ($user->update($data)) {
            return redirect()->back()->with("alert", ["message" => "Se han actualizado los datos", "type" => "success"]);
        }
        return redirect()->back()->with("alert", ["message" => "Algo ha salido mal, vuelva a intentar mas tarde.", "type" => "danger"])->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $tmp_name = $user->name;

        if ($user->delete()) {
            return redirect()->back()->with("alert", ["message" => "Se ha eliminado al usuario: " . $tmp_name, "type" => "success"]);
        }
        return redirect()->back()->with("alert", ["message" => "Algo ha salido mal, vuelva a intentar mas tarde.", "type" => "danger"]);
    }
}
