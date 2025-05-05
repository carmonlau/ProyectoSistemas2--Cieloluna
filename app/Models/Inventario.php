<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'cantidad_disponible',
        'cantidad_minima',
        'precio_unitario',
        'cantidad_por_paquete',
        'precio_por_paquete',
        'ubicacion',
        'proveedor',
        'fecha_ingreso',
        'estado'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->codigo = 'MAT-' . str_pad(self::max('id') + 1, 6, '0', STR_PAD_LEFT);
        });
    }
}