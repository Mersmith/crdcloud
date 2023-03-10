<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OdontologoSede extends Model
{
    use HasFactory;

    protected $table = 'odontologo_sede';
    protected $fillable = ['odontologo_id', 'sede_id'];

    public function odontologo()
    {
        return $this->belongsTo(Odontologo::class);
    }

    public function sede()
    {
        return $this->belongsTo(Sede::class);
    }
}
