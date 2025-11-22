<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class OAuthAccount extends Model
{
    protected $table = 'oauth_accounts'; // <— agrega esto

    protected $fillable = [
        'user_id',
        'provider',
        'provider_id',
        'provider_email'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
