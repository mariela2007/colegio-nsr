<?php
namespace App\Http\Controllers;
 
use App\Models\Evento;
use App\Models\EventoImagen;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
 
class EventoController extends Controller
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
        $eventos = Evento::with('imagenes')->get();
        return view('admin.eventos', compact('eventos'));
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'mes'         => 'required|string|max:50',
            'titulo'      => 'required|string|max:150',
            'descripcion' => 'required|string',
            'imagenes'    => 'nullable|array|max:3',
            'imagenes.*'  => 'image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);
 
        $evento = Evento::create([
            'mes'         => $request->mes,
            'titulo'      => $request->titulo,
            'descripcion' => $request->descripcion,
        ]);
 
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $img) {
                $url = $this->uploadToCloudinary($img);
                EventoImagen::create([
                    'evento_id' => $evento->id,
                    'imagen'    => $url,
                ]);
            }
        }
 
        return back()->with('success', 'Evento creado correctamente.');
    }
 
    public function edit($id)
    {
        $evento = Evento::with('imagenes')->findOrFail($id);
        return view('admin.eventos-edit', compact('evento'));
    }
 
    public function update(Request $request, $id)
    {
        $request->validate([
            'mes'         => 'required|string|max:50',
            'titulo'      => 'required|string|max:150',
            'descripcion' => 'nullable|string',
            'imagenes'    => 'nullable|array',
            'imagenes.*'  => 'image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);
 
        $evento = Evento::with('imagenes')->findOrFail($id);
        $evento->update([
            'mes'         => $request->mes,
            'titulo'      => $request->titulo,
            'descripcion' => $request->descripcion,
        ]);
 
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $img) {
                $url = $this->uploadToCloudinary($img);
                $evento->imagenes()->create(['imagen' => $url]);
            }
        }
 
        return redirect()->route('admin.eventos.edit', $id)
                         ->with('success', 'Evento actualizado correctamente.');
    }
 
    public function destroy($id)
    {
        $evento = Evento::with('imagenes')->findOrFail($id);
        foreach ($evento->imagenes as $img) {
            $img->delete();
        }
        $evento->delete();
        return redirect()->route('admin.eventos')
                         ->with('success', 'Evento eliminado correctamente.');
    }
 
    public function deleteImage($id)
    {
        $img = EventoImagen::findOrFail($id);
        $eventoId = $img->evento_id;
        $img->delete();
        return redirect()->route('admin.eventos.edit', $eventoId)
                         ->with('success', 'Imagen eliminada correctamente.');
    }
}