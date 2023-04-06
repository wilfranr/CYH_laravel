<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tercero extends Model
{
    use HasFactory;
    protected $fillable = [
        'razon_social',
        'tipo_documento',
        'numero_documento',
        'direccion',
        'telefono',
        'email',
        'rol',
        'dv',
        'ciudad_id',
        'departamento_id',
        'pais_id',
        'codigo_postal',
        'estado',
        'forma_pago',
        'email_factura_electronica',
        'rut',
        'certificacion_bancaria',
        'sitio_web',
        'puntos'
    ];

    public function cliente()
    {
        return $this->hasOne(Cliente::class);
    }

    public function proveedor()
    {
        return $this->hasOne(Proveedor::class);
    }
}
