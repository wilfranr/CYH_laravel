<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Ciudad extends Model
{
    use HasFactory;

    protected $table = 'ciudad'; // Nombre de la tabla en la base de datos

    protected $primaryKey = 'CiudadID';

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'PaisCodigo');
    }
}
