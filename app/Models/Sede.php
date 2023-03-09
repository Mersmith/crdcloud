<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'direccion'];

    public function administradores()
    {
        return $this->hasMany(Administrador::class);
    }

    public function encargados()
    {
        return $this->hasMany(Encargado::class);
    }

    public function odontologos()
    {
        return $this->belongsToMany(Odontologo::class, 'odontologo_sede');
    }

    public function pacientes()
    {
        return $this->hasMany(Paciente::class);
    }
}
