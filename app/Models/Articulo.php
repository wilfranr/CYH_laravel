<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;
    protected $fillable = [
        'marca',
        'sistema',
        'definicion',
        'referencia',
        'cantidad',
        'comentarios',
        'descripcion_especifica',
        'peso',
        'fotoDescriptiva',
    ];

    public function medidas()
    {
        return $this->belongsToMany(Medida::class, 'articulo_medida', 'articulo_id', 'medida_id');
    }

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'articulo_pedido')
            ->withPivot('cantidad')
            ->withTimestamps();
    }

    public function fotos()
    {
        return $this->hasMany(Foto::class);
    }

    public function imagenes()
    {
        return $this->hasMany(Imagen::class);
    }

    // public function maquinas()
    // {
    //     return $this->belongsToMany(Maquina::class, 'maquina_articulo')
    //         ->withPivot('id');
    // }
}
