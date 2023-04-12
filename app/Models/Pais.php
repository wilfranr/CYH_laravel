<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $primaryKey = 'PaisCodigo';
    public $incrementing = false;

    public function ciudades()
    {
        return $this->hasMany(Ciudad::class, 'PaisCodigo');
    }
}
