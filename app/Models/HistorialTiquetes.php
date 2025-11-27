<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialTiquetes extends Model
{
    protected $table = 'historial_tiquetes';
    protected $primaryKey = 'id_historial';
    protected $fillable = [
        'id_ticket',
        'cantidad_impresa',
        'usuario',
        'fecha_impresion'
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'id_ticket', 'id_ticket');
    }
}
