<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CanjeoDetalle extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at', 'estado'];

    public function canjeo()
    {
        return $this->belongsTo(Canjeo::class);
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }
}
