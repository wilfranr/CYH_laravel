<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'email',
    ];

    public function terceros()
    {
        return $this->belongsToMany(Tercero::class, 'contacto_tercero', 'contacto_id', 'tercero_id');
    }
}
