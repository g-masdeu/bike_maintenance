<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EspecificacionBicicleta extends Model
{
    use HasFactory;

    protected $fillable = [
        'modelo','tipo_bici','tipo_freno','horquilla','recorrido_horquilla','bloqueo_remoto_horquilla',
        'amortiguador','bloqueo_remoto_amortiguador','motor','bateria','cuadro','rodado',
        'cambio','marca_cambio','tipo_cambio','velocidades','cassette','desviador','mandos_cambio',
        'bielas','platos','ruedas','material_rueda','material_potencia','material_manillar',
        'tija_sillin','potenciometro','condicion_estetica'
    ];

    public function bicicletas() {
        return $this->hasMany(Bicicleta::class, 'especificacion_id');
    }
}
