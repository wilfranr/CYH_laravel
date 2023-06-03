<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoArticuloTemporal extends Model
{
    use HasFactory;

    protected $table = 'fotos_articulo_temporal';

    protected $fillable = [
        'articulo_temporal_id',
        'ruta_foto',
    ];

    public function articuloTemporal()
    {
        return $this->belongsTo(ArticuloTemporal::class, 'articulo_temporal_id');
    }
}

