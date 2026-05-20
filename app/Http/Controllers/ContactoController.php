<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    // Guardar mensaje del formulario público
    public function store(Request $request)
    {
        $request->validate([
            'nombre'  => 'required|string|max:100',
            'email'   => 'required|email',
            'telefono'=> 'nullable|string|max:20',
            'asunto'  => 'nullable|string|max:100',
            'mensaje' => 'required|string',
        ], [
            'nombre.required'  => '⚠️ Escribe tu nombre.',
            'email.required'   => '⚠️ Escribe tu correo.',
            'email.email'      => '⚠️ El correo no es válido.',
            'mensaje.required' => '⚠️ Escribe tu mensaje.',
        ]);

        Contacto::create($request->all());

        return back()->with('success', '✅ Mensaje enviado correctamente. Te responderemos pronto.');
    }

    // Ver mensajes en el admin
    public function index()
    {
        $contactos = Contacto::orderBy('created_at', 'desc')->get();
        return view('admin.contactos', compact('contactos'));
    }

    // Marcar como leído
    public function marcarLeido($id)
    {
        Contacto::findOrFail($id)->update(['leido' => true]);
        return back()->with('success', 'Mensaje marcado como leído.');
    }

    // Eliminar mensaje
    public function destroy($id)
    {
        Contacto::findOrFail($id)->delete();
        return back()->with('success', 'Mensaje eliminado.');
    }
}