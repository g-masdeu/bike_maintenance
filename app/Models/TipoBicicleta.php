<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoBicicleta extends Model
{
    use HasFactory;

    protected $fillable = ['nom'];

    // Bicicletas d’aquest tipus
    public function bicicletas()
    {
        return $this->hasMany(Bicicleta::class, 'tipo_id');
    }

    // Manteniments associats a aquest tipus
    public function mantenimientos()
    {
        return $this->hasMany(Mantenimiento::class, 'tipo_bici_id');
    }
}
