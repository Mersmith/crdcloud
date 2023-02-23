<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at', 'estado'];

    const PENDIENTE = 1;
    const PAGADO = 2;
    const ANULADO = 3;
}
