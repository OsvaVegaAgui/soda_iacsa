<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoSoda extends Model
{
    protected $table = 'productos_soda';
    protected $primaryKey = 'id_producto_soda';

    protected $fillable = [
        'nombre',
        'codigo_softland',
        'codigo_barras',
        'precio',
        'activo',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'activo' => 'boolean',
    ];
}
