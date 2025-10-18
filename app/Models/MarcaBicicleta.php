<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarcaBicicleta extends Model
{
    use HasFactory;

    protected $fillable = ['nom'];

    public function bicicletas()
    {
        return $this->hasMany(Bicicleta::class, 'marca_id');
    }
}
