<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'mobile', 'user_code', 'password', 'avatar', 'company_name', 'email_verified', 'mobile_verified', 'status', 'token', 'is_complete',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userAddress()
    {
        return $this->hasOne(UserAddress::class, 'user_id', 'id');
    }
}
