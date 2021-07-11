<?php

namespace App;

use App\City;
use App\Country;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{

    protected $table = 'states';

    protected $fillable = ['name', 'country_id'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }

}
