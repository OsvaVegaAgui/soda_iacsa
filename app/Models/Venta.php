<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';
    protected $primaryKey = 'id';

    protected $fillable = [
        'fecha', 'user_id',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    // Venta pertenece a un usuario (App\Models\User por convención)
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    // Una venta tiene muchos detalles
    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class, 'venta_id', 'id');
    }
}
