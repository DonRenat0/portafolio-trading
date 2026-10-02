<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etiqueta extends Model
{
    protected $table = 'etiquetas';
        public $timestamps = false;

    protected $fillable = ['nombre', 'color'];
}