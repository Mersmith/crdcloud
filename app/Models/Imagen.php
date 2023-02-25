<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    use HasFactory;

    protected $fillable = ['imagen_ruta', 'imagenable_id', 'imagenable_type', 'posicion'];

    public function imagenable()
    {
        return $this->morphTo();
    }
}
