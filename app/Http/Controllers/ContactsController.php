<?php

namespace App\Http\Controllers;

use App\Models\Contacts;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    function index()
    {
        return view('portal.contact');
    }

    function save(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required',
            'last_name' => '',
            'message'   => 'required',
            'email'     => 'required|email',
        ], [
            'name.required'      => 'Nombre es requerido...',
            'last_name.required' => 'Apellido es requerido',
            'message.required'   => 'Mensaje es requerido',
            'email.required'     => 'email es requerido',
        ]);

        $contact = Contacts::create($data);

        if ($contact) {
            return redirect()->route('portal.contact.index')->with('message', 'Gracias por contactar con nosotros, le responderemos lo mas pronto posible')->with('type', 'success');
        }
        return redirect()->route('portal.contact.index')->with('message', 'Algo ha salido mal, por favor pruebe nuevamente')->with('type', 'error')->withInput();
    }
}
