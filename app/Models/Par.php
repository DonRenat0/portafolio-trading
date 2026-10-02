<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Par extends Model
{
    protected $table = 'pares';
public $timestamps = false; 
    protected $fillable = ['nombre', 'tipo'];

    public function operaciones()
{
    return $this->hasMany(Operacion::class, 'id_par');
}
}
