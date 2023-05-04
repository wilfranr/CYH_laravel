<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medida extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'unidad',
        'valor',
        'tipo',
        'idMedida',
        'foto'
    ];

    public function articulos()
    {
        return $this->belongsToMany(Articulo::class, 'articulo_medida', 'medida_id', 'articulo_id');
    }
    
}

