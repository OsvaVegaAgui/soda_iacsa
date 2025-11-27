<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaTicket extends Model
{
    protected $table = 'categoria_tiquetes';
    protected $primaryKey = 'id_categoria';

    protected $fillable = [
        'nombre',
    ];
}
