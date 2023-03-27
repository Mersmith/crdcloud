<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenPerfil extends Model
{
    use HasFactory;

    protected $fillable = ['imagen_perfil_ruta', 'imagen_perfilable_id', 'imagen_perfilable_type'];

    public function imagen_perfilable()
    {
        return $this->morphTo();
    }
}
