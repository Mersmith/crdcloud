<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

    protected $table = 'direccions';

    protected $guarded = ['id', 'created_at', 'updated_at', 'posicion'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function usuarios()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function distrito()
    {
        return $this->belongsTo(Distrito::class);
    }

}
