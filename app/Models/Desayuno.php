<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Desayuno extends Model
{
    protected $table = 'desayuno';
    protected $primaryKey = 'id_desayuno';

    protected $fillable = [
        'dia', 'platillo'
    ];
}
