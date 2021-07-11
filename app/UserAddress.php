<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $table = 'user_addresses';

    protected $fillable = ['user_id', 'name', 'address', 'city', 'state', 'country', 'zip'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

}
