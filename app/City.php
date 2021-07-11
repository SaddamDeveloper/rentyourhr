<?php

namespace App;

use App\State;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    protected $table = 'cities';

    protected $fillable = ['name', 'state_id'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

}
