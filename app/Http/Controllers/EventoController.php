<?php
namespace App\Http\Controllers;
 
use App\Models\Evento;
use App\Models\EventoImagen;
use Illuminate\Http\Request;
 
class EventoController extends Controller
{
    /* ───────────────────────────────────────
       LISTAR EVENTOS
    _________________________________________*/
    public function index()
    {
        $eventos = Evento::with('imagenes')->get();
        return view('admin.eventos', compact('eventos'));
    }
 
    /* ───────────────────────────────────────
       CREAR EVENTO
    _________________________________________*/
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
            if (count($request->file('imagenes')) > 3) {
                return back()->with('error', 'Máximo 3 imágenes por evento.');
            }
 
            foreach ($request->file('imagenes') as $img) {
                $nombre = time() . '_' . uniqid() . '.' . $img->getClientOriginalExtension();
                $img->move(public_path('meses'), $nombre);
 
                EventoImagen::create([
                    'evento_id' => $evento->id,
                    'imagen'    => $nombre,
                ]);
            }
        }
 
        return back()->with('success', 'Evento creado correctamente.');
    }
 
    /* ───────────────────────────────────────
       FORMULARIO EDITAR
    _________________________________________*/
    public function edit($id)
    {
        $evento = Evento::with('imagenes')->findOrFail($id);
        return view('admin.eventos-edit', compact('evento'));
    }
 
    /* ───────────────────────────────────────
       ACTUALIZAR EVENTO
    _________________________________________*/
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
            $totalActual = $evento->imagenes()->count();
            $totalNuevo  = count($request->file('imagenes'));
 
            if (($totalActual + $totalNuevo) > 3) {
                return back()->with('error', 'Máximo 3 imágenes por evento. Actualmente tienes ' . $totalActual . '.');
            }
 
            foreach ($request->file('imagenes') as $img) {
                $nombre = time() . '_' . uniqid() . '.' . $img->getClientOriginalExtension();
                $img->move(public_path('meses'), $nombre);
 
                $evento->imagenes()->create(['imagen' => $nombre]);
            }
        }
 
        return redirect()->route('admin.eventos.edit', $id)
                         ->with('success', 'Evento actualizado correctamente.');
    }
 
    /* ───────────────────────────────────────
       ELIMINAR EVENTO (con sus imágenes)
    _________________________________________*/
    public function destroy($id)
    {
        $evento = Evento::with('imagenes')->findOrFail($id);
 
        foreach ($evento->imagenes as $img) {
            $ruta = public_path('meses/' . $img->imagen);
            if (file_exists($ruta)) {
                unlink($ruta);
            }
            $img->delete();
        }
 
        $evento->delete();
 
        return redirect()->route('admin.eventos')
                         ->with('success', 'Evento eliminado correctamente.');
    }
 
    /* ───────────────────────────────────────
       ELIMINAR IMAGEN INDIVIDUAL
    _________________________________________*/
    public function deleteImage($id)
    {
        $img = EventoImagen::findOrFail($id);
 
        $eventoId = $img->evento_id;
 
        $ruta = public_path('meses/' . $img->imagen);
        if (file_exists($ruta)) {
            unlink($ruta);
        }
 
        $img->delete();
 
        return redirect()->route('admin.eventos.edit', $eventoId)
                         ->with('success', 'Imagen eliminada correctamente.');
    }
}