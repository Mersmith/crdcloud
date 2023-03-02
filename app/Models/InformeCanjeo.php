<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformeCanjeo extends Model
{
    use HasFactory;

    protected $fillable = ['informe_canjeo_ruta', 'informe_canjeoable_id', 'informe_canjeoable_type'];

    public function informe_canjeoable()
    {
        return $this->morphTo();
    }
}
