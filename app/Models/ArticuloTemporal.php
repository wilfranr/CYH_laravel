<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pedido;

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
        return $this->hasMany(FotoArticuloTemporal::class, 'articulo_temporal_id');
    }

    public function pedido()
    {
        return $this->belongsToMany(Pedido::class, 'pedidos_articulos_temporales', 'articulo_temporal_id', 'pedido_id')->withTimestamps();
    }



    public function fotosArticuloTemporal()
    {
        return $this->hasMany(FotoArticuloTemporal::class);
    }
}
