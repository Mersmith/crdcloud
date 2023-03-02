<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenCanjeo extends Model
{
    use HasFactory;

    protected $fillable = ['imagen_canjeo_ruta', 'imagen_canjeoable_id', 'imagen_canjeoable_type', 'posicion'];

    public function imagen_canjeoable()
    {
        return $this->morphTo();
    }
}
