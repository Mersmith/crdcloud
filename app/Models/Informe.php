<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informe extends Model
{
    use HasFactory;

    protected $fillable = ['informe_ruta', 'informeable_id', 'informeable_type'];

    public function informeable()
    {
        return $this->morphTo();
    }
}
