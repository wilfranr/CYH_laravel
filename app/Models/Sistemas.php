<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sistemas extends Model
{
    use HasFactory;
    protected $table = 'sistemas';
    protected $fillable = ['nombre'];

    public function terceros()
    {
        return $this->belongsToMany(Tercero::class, 'tercero_sistema', 'sistema_id', 'tercero_id');
    }
}
