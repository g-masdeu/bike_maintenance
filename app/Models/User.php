<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Bicicleta;

// 2. Implementar MustVerifyEmail
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Los atributos que se pueden asignar masivamente.
     * He añadido los nuevos campos que creamos en la migración.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'is_active',
        'profile_photo',
        'last_login_at',
    ];

    /**
     * Atributos ocultos (no cambian).
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casts para tipos de datos.
     * Añadimos is_active y last_login_at para que Laravel los trate bien.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
        'last_login_at' => 'datetime',
    ];

    public function bicicletas()
    {
        return $this->hasMany(Bicicleta::class);
    }
}
