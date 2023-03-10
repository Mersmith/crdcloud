<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion'];

    public function odontologos()
    {
        return $this->hasMany(Odontologo::class);
    }
}
