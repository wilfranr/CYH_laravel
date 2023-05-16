<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticuloTemporal extends Model
{
    use HasFactory;

    protected $table = 'articulo_temporal';

    protected $fillable = [
        'pedido_id',
        'referencia',
        'definicion',
        'sistema',
        'cantidad',
        'comentarios'
    ];

    public function fotos()
    {
        return $this->morphMany(Foto::class, 'imageable');
    }

    public function pedido()
    {
        return $this->belongsToMany(Pedido::class);
    }

    public function fotosArticuloTemporal()
    {
        return $this->hasMany(FotoArticuloTemporal::class);
    }

    
}
