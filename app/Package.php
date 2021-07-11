<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'packages';

    protected $fillable = ['job_profile_id', 'amount', 'replace_day', 'status'];

    public function job()
    {
        return $this->belongsTo(JobProfile::class, 'job_profile_id', 'id');
    }
}
