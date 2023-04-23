<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoArticulo extends Model
{
    use HasFactory;
    protected $fillable = [
        'articulo_id',
        'ruta_foto',
    ];

    public function articulo()
    {
        return $this->belongsTo(Articulo::class);
    }
}
