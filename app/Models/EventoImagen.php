<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventoImagen extends Model
{
    protected $table = 'evento_imagenes'; // 👈 CLAVE

    protected $fillable = [
        'evento_id',
        'imagen'
    ];
    public function evento()
{
    return $this->belongsTo(Evento::class);
}
}