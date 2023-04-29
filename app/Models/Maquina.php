<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maquina extends Model
{
    use HasFactory;
    protected $fillable = [
        'tipo',
        'marca',
        'modelo',
        'serie',
        'arreglo',
        'foto',
        'fotoId'
    ];
    public function terceros()
    {
        return $this->belongsToMany(Tercero::class, 'tercero_maquina', 'maquina_id', 'tercero_id');
    }

    public static function allWithConcatenatedData()
    {
        return self::all()->map(function ($maquina) {
            $concatenatedData = $maquina->tipo . ' ' . $maquina->marca . ' ' . $maquina->modelo . ' ' . $maquina->serie;
            return [
                'id' => $maquina->id,
                'text' => $concatenatedData
            ];
        });
    }

    public function articulos()
    {
        return $this->belongsToMany(Articulo::class, 'maquina_articulo')
            ->withPivot('fabricante', 'tipo_maquina');
    }
}
