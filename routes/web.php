<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('inicio');
});
Route::get('/', fn() => view('inicio'));
Route::get('/nosotros', fn() => view('nosotros'));
Route::get('/programas', fn() => view('programas'));
Route::get('/biblioteca', fn() => view('biblioteca'));
Route::get('/contacto', fn() => view('contacto'));