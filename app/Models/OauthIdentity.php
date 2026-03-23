<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OauthIdentity extends Model
{
    protected $fillable = ['user_id', 'provider_name', 'provider_id', 'access_token'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}