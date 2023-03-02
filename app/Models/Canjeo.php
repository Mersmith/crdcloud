<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Canjeo extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at', 'estado'];

    const PENDIENTE = 1;
    const APLICADO = 2;
    const ANULADO = 3;

    public function canjeoDetalle()
    {
        return $this->hasMany(CanjeoDetalle::class);
    }

    public function sede()
    {
        return $this->belongsTo(Sede::class);
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function odontologo()
    {
        return $this->belongsTo(Odontologo::class);
    }

    public function clinica()
    {
        return $this->belongsTo(Clinica::class);
    }

    public function imagenesCanjeo()
    {
        return $this->morphMany(ImagenCanjeo::class, "imagen_canjeoable");
    }

    public function informesCanjeo()
    {
        return $this->morphMany(InformeCanjeo::class, "informe_canjeoable");
    }
}
