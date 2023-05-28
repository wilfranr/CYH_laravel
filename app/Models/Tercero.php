<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pais;
use App\Models\Ciudad;
use App\Models\Proveedor;
use App\Models\Pedido;
use App\Models\Maquina;
use App\Models\Contacto;
use App\Models\Marca;


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
    protected $guarded = ['marca[]'];

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'PaisCodigo', 'PaisCodigo');
    }
    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class, 'CiudadID', 'CiudadID');
    }


    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    public function proveedor()
    {
        return $this->hasOne(Proveedor::class);
    }

    public function maquinas()
    {
        return $this->belongsToMany(Maquina::class, 'tercero_maquina', 'tercero_id', 'maquina_id');
    }

    public function contactos()
    {
        return $this->belongsToMany(Contacto::class, 'contacto_tercero', 'tercero_id', 'contacto_id');
    }

    // Relación muchos a muchos con el modelo Marca
    public function marcas()
    {
        return $this->belongsToMany(Marca::class, 'tercero_marca', 'tercero_id', 'marca_id');
    }

    // Relación muchos a muchos con el modelo Sistemas
    public function sistemas()
    {
        return $this->belongsToMany(Sistemas::class, 'tercero_sistema', 'tercero_id', 'sistema_id');
    }
}
