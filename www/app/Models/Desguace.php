<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desguace extends Model
{
    use HasFactory;

    public function empleados()
    {
        return $this->hasMany(User::class);
    }

    public function articulos()
    {
        return $this->hasMany(Articulo::class);
    }

}
