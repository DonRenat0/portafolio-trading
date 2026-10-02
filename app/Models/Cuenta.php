<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    protected $table = 'cuenta';
        public $timestamps = false;

    protected $fillable = ['nombre', 'capital_inicial', 'fecha_inicio', 'descripcion'];
}