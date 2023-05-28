<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table = 'marcas';
    protected $fillable = ['nombre'];

    public function terceros()
    {
        return $this->belongsToMany(Tercero::class, 'tercero_marca', 'marca_id', 'tercero_id');
    }
}


