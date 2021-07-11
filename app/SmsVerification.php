<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsVerification extends Model
{
    protected $table = 'sms_verifications';

    protected $fillable = [
        'contact_number', 'code', 'resend',
    ];
}
