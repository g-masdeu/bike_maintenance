<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BicicletaMantenimiento extends Pivot
{
    use HasFactory;

    protected $table = 'bicicleta_mantenimiento';

    protected $fillable = [
        'bicicleta_id',
        'mantenimiento_id',
        'fecha_realizado',
        'kms_al_realizar',
    ];
}
