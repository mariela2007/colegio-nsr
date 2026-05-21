<?php

namespace App\Http\Controllers;
use App\Models\ImagenPrograma;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;

class ImagenProgramaController extends Controller
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
        $img->imagen = $this->uploadToCloudinary($request->file('imagen'));
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
        $img->delete();
        return back()->with('success', 'Imagen de ' . ucfirst($programa) . ' eliminada correctamente.');
    }
}
