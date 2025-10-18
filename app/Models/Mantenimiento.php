<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'descripcion',
        'kms_interval',
        'time_interval',
        'tipo_bici_id',
    ];

    public function tipoBici()
    {
        return $this->belongsTo(TipoBicicleta::class, 'tipo_bici_id');
    }

    public function bicicletas()
    {
        return $this->belongsToMany(Bicicleta::class, 'bicicleta_mantenimiento')
            ->withPivot('fecha_realizado', 'kms_al_realizar')
            ->withTimestamps();
    }
}
