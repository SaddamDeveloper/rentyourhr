<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\JobProfile;
use App\Package;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class PackageController extends Controller
{
    public function index(Request $request, $type = null)
    {
        $keyword = $request->input('keyword', null);
        $data    = Package::orderBy('updated_at', 'DESC')
            ->where(function ($q) use ($keyword, $type) {
                if ($type === null || $type === 'active') {
                    $q->where('status', 1);
                }
                if ($type === 'archived') {
                    $q->where('status', 0);
                }
                if ($keyword) {
                    $q->where('amount', 'LIKE', '%' . $keyword . '%');
                }
            })
            ->with('job')
            ->paginate(10);
        return view('admin.packages.list', compact('data', 'request'));
    }

    public function create()
    {
        $jobs = JobProfile::orderBy('updated_at', 'DESC')
            ->where('status', 1)
            ->get();
        return view('admin.packages.add', compact('jobs'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'job_profile_id' => 'required',
            'amount'         => 'required',
            'replace_day'    => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    "status"  => 'validation_error',
                    "message" => $validator->errors(),
                ],
            ], 200);
        }
        $package                 = new Package;
        $package->job_profile_id = $request->input('job_profile_id');
        $package->amount         = $request->input('amount');
        $package->replace_day    = $request->input('replace_day');
        if ($package->save()) {
            return response()->json([
                'data' => [
                    "status"  => 'success',
                    "message" => "Package has been created successfully.",
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
        $package = Package::findOrFail($id);
        $jobs    = JobProfile::orderBy('updated_at', 'DESC')
            ->where('status', 1)
            ->get();
        return view('admin.packages.edit', compact('package', 'jobs'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'job_profile_id' => 'required',
            'amount'         => 'required',
            'replace_day'    => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    "status"  => 'validation_error',
                    "message" => $validator->errors(),
                ],
            ], 200);
        }
        $package                 = Package::findOrFail($id);
        $package->job_profile_id = $request->input('job_profile_id');
        $package->amount         = $request->input('amount');
        $package->replace_day    = $request->input('replace_day');
        $package->updated_at     = Carbon::now()->toDateTimeString();
        if ($package->save()) {
            return response()->json([
                'data' => [
                    "status"  => 'success',
                    "message" => "Package has been updated successfully.",
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
        $package = Package::findOrFail($id);
        if ($package) {
            $package->update([
                'status' => 0,
            ]);
            return response()->json([
                'success' => [
                    'message' => "Package has been removed",
                ],
            ], 200);
        } else {
            return response()->json([
                'error' => [
                    'message' => "Package Not Found",
                ],
            ], 200);
        }
    }

    public function restore($id)
    {
        $package = Package::findOrFail($id);
        if ($package) {
            $package->update([
                'status' => 1,
            ]);
            return response()->json([
                'success' => [
                    'message' => "Package has been restored",
                ],
            ], 200);
        } else {
            return response()->json([
                'error' => [
                    'message' => "Package Not Found",
                ],
            ], 200);
        }
    }

}
