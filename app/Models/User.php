<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
        'profile_photo_path',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relació amb bicicletes
    public function bicicletas()
    {
        return $this->hasMany(Bicicleta::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // Método para mostrar iniciales en edit profile
    public function initials(): string
    {
        $names = explode(' ', $this->name);
        $initials = '';

        foreach ($names as $n) {
            $initials .= mb_substr($n, 0, 1);
        }

        return strtoupper($initials);
    }

    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo_path 
            ? asset('storage/' . $this->profile_photo_path) 
            : asset('/images/default-avatar.png');
    }


}
