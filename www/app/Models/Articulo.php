<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'marca',
        'modelo',
        'anio',
        'precio',
        'imagen',
        'desguace_id'
    ];


    public function desguace()
    {
        return $this->belongsTo(Desguace::class);
    }

}
