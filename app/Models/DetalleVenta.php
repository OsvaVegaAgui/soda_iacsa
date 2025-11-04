<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table = 'detalle_venta';
    protected $primaryKey = 'id';

    protected $fillable = [
        'venta_id',
        'codigo',
        'cantidad_vendida',
        'precio_unitario',
        'subtotal',
    ];

    protected $casts = [
        'cantidad_vendida' => 'integer',
        'precio_unitario'  => 'decimal:2',
        'subtotal'         => 'decimal:2',
    ];
    
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'venta_id', 'id');
    }
}
