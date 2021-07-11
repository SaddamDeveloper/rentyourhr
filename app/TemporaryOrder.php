<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemporaryOrder extends Model
{
    protected $table = 'temporary_orders';

    protected $fillable = ['user_id', 'job_profile_id', 'package_id', 'price', 'quantity', 'min_salary', 'max_salary', 'experience', 'description', 'amount', 'address', 'state', 'city', 'zip', 'gst_number', 'cgst', 'sgst', 'igst', 'total', 'status'];

    public function position()
    {
        return $this->belongsTo(JobProfile::class, 'job_profile_id', 'id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id', 'id');
    }

}
