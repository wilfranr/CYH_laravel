<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tercero extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'tipo_documento',
        'numero_documento',
        'direccion',
        'telefono',
        'email',
        'tipo',
        'dv',
        'PaisCodigo',
        'CiudadID',
        'codigo_postal',
        'estado',
        'forma_pago',
        'email_factura_electronica',
        'rut',
        'certificacion_bancaria',
        'sitio_web',
        'puntos'
    ];
    public function pais()
    {
        return $this->belongsTo(Pais::class, 'PaisCodigo', 'PaisCodigo');
    }
    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class, 'CiudadID', 'CiudadID');
    }


    public function cliente()
    {
        return $this->hasOne(Cliente::class);
    }

    public function proveedor()
    {
        return $this->hasOne(Proveedor::class);
    }
}
