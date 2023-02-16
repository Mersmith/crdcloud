<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'departamento_id'];

    public function distritos()
    {
        return $this->hasMany(Distrito::class);
    }
}
