<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoCocina extends Model
{
    protected $table = 'productos_cocina';
    protected $primaryKey = 'id_producto_cocina';
    
    protected $fillable = [
        'nombre_producto_cocina',
        'codigo',
        'cantidad_hecha',
        'precio_producto_cocina',
        'categoria_institucion',
    ];

    protected $casts = [
        'cantidad_hecha'        => 'integer',
        'precio_producto_cocina' => 'decimal:2',
    ];
}
