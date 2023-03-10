<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PacienteSede extends Model
{
    use HasFactory;

    protected $table = 'paciente_sede';
    protected $fillable = ['paciente_id', 'sede_id'];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function sede()
    {
        return $this->belongsTo(Sede::class);
    }
}
