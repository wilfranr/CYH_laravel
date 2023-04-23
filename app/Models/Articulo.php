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
    ];
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }



    public function fotos()
    {
        return $this->hasMany(Foto::class);
    }
}
