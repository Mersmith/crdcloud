<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'provincia_id'];

    public function usuarios()
    {
        return $this->hasManyThrough(
            User::class,
            Direccion::class,
            'distrito_id', // Clave foránea de la tabla "direccions"
            'id', // Clave primaria de la tabla "users"
            'id', // Clave primaria de la tabla "distritos"
            'user_id' // Clave foránea de la tabla "users"
        );
    }

    public function direcciones()
    {
        return $this->hasManyThrough(
            Direccion::class,
            Provincia::class,
            'departamento_id', // La clave foránea de departamento en la tabla de provincias
            'provincia_id' // La clave foránea de provincia en la tabla de direcciones
        );
    }
}
