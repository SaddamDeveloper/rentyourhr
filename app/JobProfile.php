<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobProfile extends Model
{
    protected $table = 'job_profiles';

    protected $fillable = ['job_name', 'salary', 'must_have', 'good_to_have', 'status'];

    public function packages()
    {
        return $this->hasMany(Package::class, 'job_profile_id', 'id');
    }
}
