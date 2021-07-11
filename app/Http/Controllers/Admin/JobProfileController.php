<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\JobProfile;
use App\Package;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class JobProfileController extends Controller
{
    public function index(Request $request, $type = null)
    {
        $keyword = $request->input('keyword', null);
        $data    = JobProfile::orderBy('updated_at', 'DESC')
            ->where(function ($q) use ($keyword, $type) {
                if ($type === null || $type === 'active') {
                    $q->where('status', 1);
                }
                if ($type === 'archived') {
                    $q->where('status', 0);
                }
                if ($keyword) {
                    $q->where('job_name', 'LIKE', '%' . $keyword . '%');
                    $q->orWhere('minimum', 'LIKE', '%' . $keyword . '%');
                    $q->orWhere('maximum', 'LIKE', '%' . $keyword . '%');
                }
            })->paginate(10);
        return view('admin.job_profiles.list', compact('data', 'request'));
    }

    public function create()
    {
        return view('admin.job_profiles.add');
    }

    public function store(Request $request)
    {
        // return $request->all();
        $validator = Validator::make($request->all(), [
            'job_name'     => 'required|unique:job_profiles,job_name',
            'salary'       => 'required',
            'must_have'    => 'required',
            'good_to_have' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    "status"  => 'validation_error',
                    "message" => $validator->errors(),
                ],
            ], 200);
        }
        $job               = new JobProfile;
        $job->job_name     = $request->input('job_name');
        $job->salary       = $request->input('salary');
        $job->must_have    = $request->input('must_have');
        $job->good_to_have = $request->input('good_to_have');
        $job->status       = 1;
        if ($job->save()) {
            return response()->json([
                'data' => [
                    "status"  => 'success',
                    "message" => "Job profile has been created successfully.",
                ],
            ], 200);
        } else {
            return response()->json([
                'data' => [
                    "status"  => 'error',
                    "message" => "Sorry a problem has occurred.",
                ],
            ], 200);
        }
    }

    public function edit($id)
    {
        $job = JobProfile::findOrFail($id);
        return view('admin.job_profiles.edit', compact('job'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'job_name'     => 'required|unique:job_profiles,job_name,' . $id,
            'salary'       => 'required',
            'must_have'    => 'required',
            'good_to_have' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    "status"  => 'validation_error',
                    "message" => $validator->errors(),
                ],
            ], 200);
        }
        $job               = JobProfile::findOrFail($id);
        $job->job_name     = $request->input('job_name');
        $job->salary       = $request->input('salary');
        $job->must_have    = $request->input('must_have');
        $job->good_to_have = $request->input('good_to_have');
        $job->status       = 1;
        $job->updated_at   = Carbon::now()->toDateTimeString();
        if ($job->save()) {
            return response()->json([
                'data' => [
                    "status"  => 'success',
                    "message" => "Job profile has been updated successfully.",
                ],
            ], 200);
        } else {
            return response()->json([
                'data' => [
                    "status"  => 'error',
                    "message" => "Sorry a problem has occurred.",
                ],
            ], 200);
        }
    }

    public function destroy($id)
    {
        $job = JobProfile::findOrFail($id);
        if ($job) {
            $job->update([
                'status' => 0,
            ]);
            return response()->json([
                'success' => [
                    'message' => "Job Profile has been removed",
                ],
            ], 200);
        } else {
            return response()->json([
                'error' => [
                    'message' => "Job Profile Not Found",
                ],
            ], 200);
        }
    }

    public function restore($id)
    {
        $job = JobProfile::findOrFail($id);
        if ($job) {
            $job->update([
                'status' => 1,
            ]);
            return response()->json([
                'success' => [
                    'message' => "Job Profile has been restored",
                ],
            ], 200);
        } else {
            return response()->json([
                'error' => [
                    'message' => "Job Profile Not Found",
                ],
            ], 200);
        }
    }

    public function getPackage($job_id)
    {
        $data = Package::orderBy('updated_at', 'DESC')
            ->where('job_profile_id', $job_id)
            ->where('status', 1)
            ->get();
        $responseHtml = view('admin.job_profiles.package_child', ['data' => $data])->render();
        return response()->json([
            'data' => [
                "status" => 'success',
                "html"   => $responseHtml,
            ],
        ], 200);

    }
}
