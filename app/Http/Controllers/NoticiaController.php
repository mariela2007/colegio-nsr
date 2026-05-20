<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    // LISTAR
    public function index()
    {
        $noticias = Noticia::all();
        return view('admin.noticias', compact('noticias'));
    }

    // CREAR
    public function store(Request $request)
    {
        $imagen = $request->file('imagen');

        $nombre = null;

        if ($imagen) {
            $nombre = time().'_'.$imagen->getClientOriginalName();
            $imagen->move(public_path('noticias'), $nombre);
        }

        Noticia::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $nombre
        ]);

        return back()->with('success', 'Noticia creada correctamente');
    }

    // EDITAR
    public function edit($id)
    {
        $noticia = Noticia::findOrFail($id);
        return view('admin.editar_noticia', compact('noticia'));
    }

    // ACTUALIZAR
    public function update(Request $request, $id)
    {
        $n = Noticia::findOrFail($id);

        if ($request->hasFile('imagen')) {

    // borrar imagen anterior
    if ($n->imagen && file_exists(public_path('noticias/'.$n->imagen))) {
        unlink(public_path('noticias/'.$n->imagen));
    }

    // guardar nueva imagen
    $imagen = $request->file('imagen');
    $nombre = time().'_'.$imagen->getClientOriginalName();
    $imagen->move(public_path('noticias'), $nombre);

    $n->imagen = $nombre;
}

        $n->titulo = $request->titulo;
        $n->descripcion = $request->descripcion;
        $n->save();

        return redirect('/admin/noticias')->with('success', 'Noticia actualizada');
    }

    // ELIMINAR
    public function destroy($id)
    {
        $n = Noticia::findOrFail($id);

        if ($n->imagen && file_exists(public_path('noticias/'.$n->imagen))) {
            unlink(public_path('noticias/'.$n->imagen));
        }

        $n->delete();

        return back()->with('success', 'Noticia eliminada');
    }
}