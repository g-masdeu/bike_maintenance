<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OAuth2FASession extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'session_token',
        'provider',
        'provider_id',
        'provider_email',
        'provider_name',
        'otp_code',
        'otp_expires_at',
        'attempts',
    ];

    protected $casts = [
        'otp_expires_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function isExpired(): bool
    {
        return now()->diffInMinutes($this->created_at) > 10;
    }

    public function isOtpExpired(): bool
    {
        return $this->otp_expires_at && now()->isAfter($this->otp_expires_at);
    }
}