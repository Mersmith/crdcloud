<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicaPaciente extends Model
{
    use HasFactory;

    protected $table = 'clinica_paciente';
    protected $fillable = ['paciente_id', 'clinica_id'];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function clinica()
    {
        return $this->belongsTo(Clinica::class);
    }
}
