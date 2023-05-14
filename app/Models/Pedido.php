<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $fillable = [
        'tercero_id',
        'user_id',
        'maquina_id',
        'contacto_id',
        'comentario',
        'estado',
    ];
    public function articulos()
    {
        return $this->hasMany(Articulo::class);
    }

    //relacion terceros
    public function tercero()
    {
        return $this->belongsTo(Tercero::class);
    }


    public function items()
    {
        return $this->hasMany(ItemPedido::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function maquinas()
    {
        return $this->belongsToMany(Maquina::class, 'maquinas_pedido', 'pedido_id', 'maquina_id')->withTimestamps();
    }


    public function contacto()
    {
        return $this->belongsTo(Contacto::class);
    }

    public function articulosTemporales()
    {
        return $this->hasMany(ArticuloTemporal::class);
    }
}
