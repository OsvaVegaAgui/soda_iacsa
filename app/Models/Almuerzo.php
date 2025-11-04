<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Almuerzo extends Model
{
    protected $table = 'almuerzo';
    protected $primaryKey = 'id_almuerzo';

    protected $fillable = [
        'dia', 'platillo'
    ];
}
