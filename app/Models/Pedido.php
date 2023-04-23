<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Pedido extends Model
{
    use HasFactory;
    protected $fillable = [
        'codPedido',
        'codUsuario',
        'codCliente',
        'codMaquina',
        'fecha_creacion',
        'fecha_modificacion',
        'descripcion',
        'contacto',
        'estado',
    ];
    public function articulos()
    {
        return $this->hasMany(Articulo::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function items()
    {
        return $this->hasMany(ItemPedido::class);
    }
}
