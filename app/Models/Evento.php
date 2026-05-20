<?php

namespace App\Models;
use App\Models\EventoImagen;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $fillable = ['mes', 'titulo', 'descripcion'];

    public function imagenes()
{
    return $this->hasMany(EventoImagen::class, 'evento_id');
}

    
}
