<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'update_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sedes()
    {
        return $this->belongsToMany(Sede::class, 'paciente_sede');
    }

    public function odontologos()
    {
        return $this->belongsToMany(Odontologo::class);
    }
}
