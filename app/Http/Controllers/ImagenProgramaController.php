<?php

namespace App\Http\Controllers;
use App\Models\ImagenPrograma;

use Illuminate\Http\Request;

class ImagenProgramaController extends Controller
{
     public function index()
    {
        $imagenes = ImagenPrograma::all()->keyBy('programa');
        return view('admin.imagenes', compact('imagenes'));
    }

    public function update(Request $request, $programa)
    {
         $request->validate([
        'imagen' => 'required|image|mimes:jpeg,png,jpg,webp|max:4096',
    ], [
        'imagen.required' => '⚠️ Debes seleccionar una imagen.',
        'imagen.image'    => '⚠️ El archivo debe ser una imagen.',
    ]);

    $img = ImagenPrograma::firstOrNew(['programa' => $programa]);

    // Eliminar imagen anterior
    if ($img->imagen && file_exists(public_path('img-programas/' . $img->imagen))) {
        unlink(public_path('img-programas/' . $img->imagen));
    }

    // Guardar nueva imagen
    $nombre = time() . '_' . uniqid() . '.' . $request->file('imagen')->getClientOriginalExtension();
    $request->file('imagen')->move(public_path('img-programas'), $nombre);

    $img->imagen = $nombre;
    $img->save();

    return back()->with('success', 'Imagen de ' . ucfirst($programa) . ' actualizada correctamente.');
    }
    public function programas()
{
    $imagenes = ImagenPrograma::all()->keyBy('programa');
    return view('programas', compact('imagenes'));
}
public function destroy($programa)
{
    $img = ImagenPrograma::where('programa', $programa)->firstOrFail();

    if ($img->imagen && file_exists(public_path('img-programas/' . $img->imagen))) {
        unlink(public_path('img-programas/' . $img->imagen));
    }

    $img->delete();

    return back()->with('success', 'Imagen de ' . ucfirst($programa) . ' eliminada correctamente.');
}
}
