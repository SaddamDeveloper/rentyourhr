<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $connection = 'mysql_cv';

    protected $table = 'candidates';

    protected $fillable = ['name', 'email', 'mobile', 'user_code', 'industry', 'job_position', 'experience', 'gender', 'pan_no', 'aadhar_no', 'address', 'city', 'country', 'zip', 'current_company', 'current_job_position', 'current_salary', 'expected_salary', 'expected_location', 'date_of_birth', 'marital_status', 'passport', 'cv_file', 'cv_file_client', 'skills', 'status', 'parent_code', 'attached_on', 'parent_email', 'parent_name', 'parent_mobile', 'webite_last_update', 'is_delete'];
}
