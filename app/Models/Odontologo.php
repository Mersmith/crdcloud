<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Odontologo extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'update_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sedes()
    {
        return $this->belongsToMany(Sede::class, 'odontologo_sede');
    }

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }

    public function pacientes()
    {
        return $this->belongsToMany(Paciente::class);
    }

}
