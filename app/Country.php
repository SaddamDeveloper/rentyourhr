<?php

namespace App;

use App\State;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    protected $fillable = ['name', 'code'];

    public function states()
    {
        return $this->hasMany(State::class);
    }
}
