<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaTicket extends Model
{
    protected $table = 'categoria';
    protected $primaryKey = 'id_categoria';

    protected $fillable = [
        'nombre',
    ];

    
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'categoria_d', 'id_categoria');
    }
}
