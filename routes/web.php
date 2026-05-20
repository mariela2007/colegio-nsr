<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\ImagenProgramaController;

use App\Models\Noticia;
use App\Models\Evento;

/* ======================
   PÁGINA PRINCIPAL
====================== */
Route::get('/', function () {
    return view('inicio');
});

/* ======================
   PÁGINAS PÚBLICAS
====================== */
Route::view('/nosotros', 'nosotros');
Route::get('/programas', [ImagenProgramaController::class, 'programas']);
Route::view('/contacto', 'contacto');

/* ======================
   BIBLIOTECA (NOTICIAS + EVENTOS)
====================== */

Route::get('/biblioteca', function () {

    $noticias = Noticia::all();
    $eventos = Evento::with('imagenes')->get();

    return view('biblioteca', compact('noticias', 'eventos'));
});

/* ======================
   DASHBOARD ADMIN
====================== */
Route::get('/dashboard', function () {

    if (!auth()->check()) {
        return redirect('/login');
    }

    if (auth()->user()->role !== 'admin') {
        abort(403);
    }

    return view('admin.dashboard');

})->middleware('auth')->name('dashboard');

/* ======================
   INICIO USUARIO
====================== */
Route::get('/inicio', function () {
    return view('inicio');
})->middleware('auth');

/* ======================
   ADMIN - NOTICIAS
====================== */
Route::middleware('auth')->group(function () {

    Route::get('/admin/noticias', [NoticiaController::class, 'index'])
        ->name('admin.noticias');

    Route::post('/admin/noticias', [NoticiaController::class, 'store'])
        ->name('admin.noticias.store');

    Route::get('/admin/noticias/{id}/editar', [NoticiaController::class, 'edit'])
        ->name('admin.noticias.edit');

    // ✅ Correcto
Route::put('/admin/noticias/{id}', [NoticiaController::class, 'update'])
    ->name('admin.noticias.update');

    Route::delete('/admin/noticias/{id}', [NoticiaController::class, 'destroy'])
        ->name('admin.noticias.destroy');

   Route::get('/admin/imagenes', [ImagenProgramaController::class, 'index'])
    ->name('admin.imagenes');
});


/* ======================
   CONTACTO
====================== */
Route::post('/contacto', [ContactoController::class, 'store'])
    ->name('contacto.store');

// Rutas admin — ver mensajes
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/contactos', [ContactoController::class, 'index'])
        ->name('admin.contactos');

    Route::post('/contactos/{id}/leido', [ContactoController::class, 'marcarLeido'])
        ->name('admin.contactos.leido');

    Route::post('/contactos/{id}/delete', [ContactoController::class, 'destroy'])
        ->name('admin.contactos.destroy');
});

/* ======================
   ADMIN - EVENTOS
====================== */
Route::middleware('auth')->prefix('admin')->group(function () {

    Route::get('/eventos', [EventoController::class, 'index'])
        ->name('admin.eventos');

    Route::post('/eventos', [EventoController::class, 'store'])
        ->name('admin.eventos.store');

    Route::get('/eventos/{id}/editar', [EventoController::class, 'edit'])
        ->name('admin.eventos.edit');

    Route::post('/eventos/{id}/update', [EventoController::class, 'update'])
        ->name('admin.eventos.update');

    Route::post('/eventos/imagen/{id}/delete', [EventoController::class, 'deleteImage'])
        ->name('admin.eventos.imagen.delete');

    Route::post('/eventos/{id}/delete', [EventoController::class, 'destroy'])
        ->name('admin.eventos.destroy');

        
});
/* ======================
   PERFIL
====================== */
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});
Route::post('/admin/imagenes/{programa}', [ImagenProgramaController::class, 'update'])
    ->name('admin.imagenes.update');
    Route::post('/admin/imagenes/{programa}/delete', [ImagenProgramaController::class, 'destroy'])
    ->name('admin.imagenes.destroy');
/* ======================
   AUTH
====================== */
require __DIR__.'/auth.php';