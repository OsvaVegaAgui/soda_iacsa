<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Refrigerio extends Model
{
    protected $table = 'refrigerio';
    protected $primaryKey = 'id_refrigerio';

    protected $fillable = [
        'dia', 'platillo'
    ];
}
