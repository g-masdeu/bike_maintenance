<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bicicleta extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'marca_id',
        'tipo_id',
        'model',
        'data_compra',
        'kms_actuals',
        'kms_ultimo_mantenimiento',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tipo()
    {
        return $this->belongsTo(TipoBicicleta::class, 'tipo_id');
    }

    public function marca()
    {
        return $this->belongsTo(MarcaBicicleta::class, 'marca_id');
    }

    public function mantenimientos()
    {
        return $this->belongsToMany(Mantenimiento::class, 'bicicleta_mantenimiento')
            ->withPivot('fecha_realizado', 'kms_al_realizar')
            ->withTimestamps();
    }
    
    public function especificacion()
    {
        return $this->belongsTo(EspecificacionBicicleta::class, 'especificacion_id');
    }

}
