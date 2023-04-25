<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;
    protected $fillable = [
        'sistema',
        'definicion',
        'referencia',
        'cantidad',
        'comentarios',
        'descripcion_especifica',
        'peso',
        'foto_descriptiva'
    ];
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }



    public function fotos()
    {
        return $this->hasMany(Foto::class);
    }

    public function maquinas()
{
    return $this->belongsToMany(Maquina::class, 'maquina_articulo');
}

}
