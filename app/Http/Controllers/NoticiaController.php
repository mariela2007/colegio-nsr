<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;

class NoticiaController extends Controller
{
    private function uploadToCloudinary($file)
    {
        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ]
        ]);

        $result = $cloudinary->uploadApi()->upload($file->getRealPath());
        return $result['secure_url'];
    }

    public function index()
    {
        $noticias = Noticia::all();
        return view('admin.noticias', compact('noticias'));
    }

    public function store(Request $request)
    {
        $url = null;
        if ($request->hasFile('imagen')) {
            $url = $this->uploadToCloudinary($request->file('imagen'));
        }

        Noticia::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $url
        ]);

        return back()->with('success', 'Noticia creada correctamente');
    }

    public function edit($id)
    {
        $noticia = Noticia::findOrFail($id);
        return view('admin.editar_noticia', compact('noticia'));
    }

    public function update(Request $request, $id)
    {
        $n = Noticia::findOrFail($id);

        if ($request->hasFile('imagen')) {
            $n->imagen = $this->uploadToCloudinary($request->file('imagen'));
        }

        $n->titulo = $request->titulo;
        $n->descripcion = $request->descripcion;
        $n->save();

        return redirect('/admin/noticias')->with('success', 'Noticia actualizada');
    }

    public function destroy($id)
    {
        $n = Noticia::findOrFail($id);
        $n->delete();
        return back()->with('success', 'Noticia eliminada');
    }
}