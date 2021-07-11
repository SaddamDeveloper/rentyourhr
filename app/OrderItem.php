<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';

    protected $fillable = ['order_id', 'job_profile_id', 'package_id', 'price', 'quantity', 'min_salary', 'max_salary', 'experience', 'description', 'amount', 'address', 'state', 'city', 'zip', 'gst_number', 'cgst', 'sgst', 'igst', 'total', 'status'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function position()
    {
        return $this->belongsTo(JobProfile::class, 'job_profile_id', 'id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id', 'id');
    }

}
