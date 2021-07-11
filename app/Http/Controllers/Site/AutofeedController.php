<?php

namespace App\Http\Controllers\Site;

use App\City;
use App\Http\Controllers\Controller;
use App\JobProfile;
use App\Package;
use App\State;
use App\UserAddress;

class AutofeedController extends Controller
{

    public function getState()
    {
        $states = State::where('country_id', 1)
            ->orderBy('name', 'ASC')
            ->select('id', 'name')
            ->get();
        return response()->json([
            'success' => true,
            'states'  => $states,
        ], 200);
    }

    public function getCity($state_id)
    {
        $cities = City::where('state_id', $state_id)
            ->orderby('name', 'ASC')
            ->select('id', 'name')
            ->get();
        return response()->json([
            'success' => true,
            'cities'  => $cities,
        ], 200);

    }

    public function getPosition()
    {
        $profiles = JobProfile::select('id', 'job_name', 'minimum', 'maximum')
            ->get();

        return response()->json([
            'success'  => true,
            'profiles' => $profiles,
        ], 200);

    }

    public function getPackage($profile_id)
    {
        $packages = Package::select('id', 'amount', 'job_profile_id', 'replace_day')
            ->where('job_profile_id', $profile_id)
            ->get();
        return response()->json([
            'success'  => true,
            'packages' => $packages,
        ], 200);

    }
}
