<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'ticket';
    protected $primaryKey = 'id_ticket';

    protected $fillable = [
        'nombre', 
        'codigo', 
        'categoria_d', 
        'precio', 
        'cantidad', 
        'fecha',
    ];

    protected $casts = [
        'precio'   => 'decimal:2',
        'cantidad' => 'integer',
        'fecha'    => 'date',
    ];

    public function categoria()
    {
        return $this->belongsTo(CategoriaTicket::class, 'categoria_d', 'id_categoria');
    }
}
