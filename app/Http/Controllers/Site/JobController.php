<?php

namespace App\Http\Controllers\Site;

use App\JobProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    public function jobProfiles(Request $request)
    {
        $job_profiles = JobProfile::with('packages')
            ->get();
        return view('site.job.job_search', compact('job_profiles'));
    }

    public function singleJob()
    {
        return view('site.job.single_job');
    }
}
