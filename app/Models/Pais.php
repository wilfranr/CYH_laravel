<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'codigo'];
    protected $table = 'paises';
    protected $primaryKey = 'id_pais';
}
