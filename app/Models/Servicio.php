<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'precio_venta', 'descripcion', 'puntos_ganar', 'puntos_canjeo'];
}
