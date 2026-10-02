<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operacion extends Model
{
    protected $table = 'operaciones';
    public $timestamps = false;
    protected $fillable = [
        'id_par',
        'id_cuenta',
        'direccion',
        'fecha_entrada',
        'fecha_salida',
        'anio',
        'mes',
        'semana',
        'precio_entrada',
        'precio_salida',
        'tamano_posicion',
        'resultado_dinero',
        'resultado_porcentaje',
        'comentario',
        'imagen'
        ];

    public function par()
    {
        return $this->belongsTo(Par::class, 'id_par');
    }

    public function cuenta()
    {
        return $this->belongsTo(Cuenta::class, 'id_cuenta');
    }

    public function etiquetas()
    {
        return $this->belongsToMany(Etiqueta::class, 'operacion_etiquetas', 'id_operacion', 'id_etiqueta');
    }

    protected static function booted()
    {
        static::saving(function ($operacion) {
            if ($operacion->fecha_entrada) {
                $fecha = \Carbon\Carbon::parse($operacion->fecha_entrada);
                $operacion->anio = $fecha->year;
                $operacion->mes = $fecha->month;
                $operacion->semana = $fecha->weekOfYear;
            }
        });
    }
}