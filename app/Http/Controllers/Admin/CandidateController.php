<?php

namespace App\Http\Controllers\Admin;

use App\Candidate;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Validator;

class CandidateController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword', null);

        $data = Candidate::orderBy('updated_at', 'DESC')
            ->where(function ($q) use ($keyword) {
                if ($keyword) {
                    $q->orWhere('name', 'LIKE', '%' . $keyword . '%');
                    $q->orWhere('email', 'LIKE', '%' . $keyword . '%');
                    $q->orWhere('mobile', 'LIKE', '%' . $keyword . '%');
                    $q->orWhere('industry', 'LIKE', '%' . $keyword . '%');
                    $q->orWhere('current_company', 'LIKE', '%' . $keyword . '%');
                    $q->orWhere('address', 'LIKE', '%' . $keyword . '%');
                    $q->orWhere('city', 'LIKE', '%' . $keyword . '%');
                    $q->orWhere('country', 'LIKE', '%' . $keyword . '%');
                    $q->orWhere('zip', 'LIKE', '%' . $keyword . '%');
                    $q->orWhere('current_salary', 'LIKE', '%' . $keyword . '%');
                    $q->orWhere('user_code', 'LIKE', '%' . $keyword . '%');
                    $q->orWhere('parent_code', 'LIKE', '%' . $keyword . '%');
                    $q->orWhere('parent_email', 'LIKE', '%' . $keyword . '%');
                    $q->orWhere('parent_name', 'LIKE', '%' . $keyword . '%');
                    $q->orWhere('expected_location', 'LIKE', '%' . $keyword . '%');
                }
            })
            ->paginate(15);
        return view('admin.candidates.list', compact('data'));
    }

    public function create()
    {
        return view('admin.candidates.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'                 => 'required|string',
            'email'                => 'required|email',
            'mobile'               => 'nullable|numeric|digits_between:10,10',
            'industry'             => 'nullable|string|max:100',
            'job_position'         => 'nullable|string|max:100',
            'experience'           => 'nullable|numeric',
            'gender'               => 'nullable|string|max:10',
            'pan_no'               => 'nullable|string|max:20',
            'aadhar_no'            => 'nullable|string|max:20',
            'address'              => 'nullable|string',
            'city'                 => 'nullable|string|max:100',
            'country'              => 'nullable|string|max:100',
            'zip'                  => 'nullable|string|max:100',
            'current_company'      => 'nullable|string|max:100',
            'current_job_position' => 'nullable|string|max:100',
            'current_salary'       => 'nullable|string|max:100',
            'expected_salary'      => 'nullable|string|max:100',
            'expected_location'    => 'nullable|string|max:100',
            'date_of_birth'        => 'nullable|string|max:100',
            'marital_status'       => 'nullable|string|max:100',
            'cv_file'              => 'nullable|file|max:2048',
            'cv_file_client'       => 'nullable|file|max:2048',
            'parent_code'          => 'nullable',
            'skills'               => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    "status"  => 'validation_error',
                    "message" => $validator->errors(),
                ],
            ], 200);
        }
        $mobile        = $request->input('mobile', null);
        $old_candidate = Candidate::where('email', $request->input('email'))
            ->where(function ($q) use ($mobile) {
                if ($mobile) {
                    $q->orWhere('mobile', $mobile);
                }
            })
            ->first();
        if ($old_candidate) {
            return response()->json([
                'data' => [
                    "status"  => 'duplicate_error',
                    "message" => "This mobile or email id is already present",
                ],
            ], 200);
        }

        if ($request->input('parent_code')) {
            $attached_on = Carbon::now()->toDateTimeString();
        } else {
            $attached_on = null;
        }
        $candidate                       = new Candidate;
        $candidate->name                 = $request->input('name');
        $candidate->email                = $request->input('email');
        $candidate->mobile               = $request->input('mobile', null);
        $candidate->user_code            = 'CJ4P' . rand(10000, 99999);
        $candidate->industry             = $request->input('industry', null);
        $candidate->job_position         = $request->input('job_position', null);
        $candidate->experience           = $request->input('experience', null);
        $candidate->gender               = $request->input('gender', null);
        $candidate->pan_no               = $request->input('pan_no', null);
        $candidate->aadhar_no            = $request->input('aadhar_no', null);
        $candidate->address              = $request->input('address', null);
        $candidate->city                 = $request->input('city', null);
        $candidate->country              = $request->input('country', null);
        $candidate->zip                  = $request->input('zip', null);
        $candidate->current_company      = $request->input('current_company', null);
        $candidate->current_job_position = $request->input('current_job_position', null);
        $candidate->current_salary       = $request->input('current_salary', null);
        $candidate->expected_salary      = $request->input('expected_salary', null);
        $candidate->expected_location    = $request->input('expected_location', null);
        $candidate->date_of_birth        = $request->input('date_of_birth', null);
        $candidate->marital_status       = $request->input('marital_status', null);
        $candidate->passport             = $request->input('passport', null);
        if ($request->hasFile('cv_file')) {
            $time      = Carbon::now();
            $file      = $request->file('cv_file');
            $extension = $file->getClientOriginalExtension();
            $filename  = Str::random(5) . date_format($time, 'd') . rand(1, 9) . date_format($time, 'h') . "." . $extension;
            $extension = $file->getClientOriginalExtension();
            $file_name = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $disk      = Storage::disk('s3');
            $disk->putFileAs('cv', $file, $file_name);
            $file_url           = Storage::disk('s3')->url('cv/' . $file_name);
            $candidate->cv_file = $file_url;
        }
        if ($request->hasFile('cv_file_client')) {
            $time      = Carbon::now();
            $file      = $request->file('cv_file_client');
            $extension = $file->getClientOriginalExtension();
            $filename  = Str::random(5) . date_format($time, 'd') . rand(1, 9) . date_format($time, 'h') . "." . $extension;
            $extension = $file->getClientOriginalExtension();
            $file_name = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $disk      = Storage::disk('s3');
            $disk->putFileAs('cv', $file, $file_name);
            $file_url                  = Storage::disk('s3')->url('cv/' . $file_name);
            $candidate->cv_file_client = $file_url;
        }
        $candidate->skills             = $request->input('skills', null);
        $candidate->status             = $request->input('status', null);
        $candidate->parent_code        = $request->input('parent_code', null);
        $candidate->attached_on        = $attached_on;
        $candidate->parent_email       = $request->input('parent_email', null);
        $candidate->parent_name        = $request->input('parent_name', null);
        $candidate->parent_mobile      = $request->input('parent_mobile', null);
        $candidate->webite_last_update = 'rentyourhr';
        if ($candidate->save()) {
            return response()->json([
                'data' => [
                    "status"  => 'success',
                    "message" => "Candidate has been created successfully.",
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

    public function show($id)
    {
        $e = Candidate::findOrFail($id);
        return view('admin.candidates.show', compact('e'));
    }
    public function edit($id)
    {
        $e = Candidate::findOrFail($id);
        return view('admin.candidates.edit', compact('e'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'                 => 'required|string',
            'email'                => 'required|email',
            'mobile'               => 'nullable|numeric|digits_between:10,10',
            'industry'             => 'nullable|string|max:100',
            'job_position'         => 'nullable|string|max:100',
            'experience'           => 'nullable|numeric',
            'gender'               => 'nullable|string|max:10',
            'pan_no'               => 'nullable|string|max:20',
            'aadhar_no'            => 'nullable|string|max:20',
            'address'              => 'nullable|string',
            'city'                 => 'nullable|string|max:100',
            'country'              => 'nullable|string|max:100',
            'zip'                  => 'nullable|string|max:100',
            'current_company'      => 'nullable|string|max:100',
            'current_job_position' => 'nullable|string|max:100',
            'current_salary'       => 'nullable|string|max:100',
            'expected_salary'      => 'nullable|string|max:100',
            'expected_location'    => 'nullable|string|max:100',
            'date_of_birth'        => 'nullable|string|max:100',
            'marital_status'       => 'nullable|string|max:100',
            'cv_file'              => 'nullable|file|max:2048',
            'cv_file_client'       => 'nullable|file|max:2048',
            'parent_code'          => 'nullable',
            'skills'               => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    "status"  => 'validation_error',
                    "message" => $validator->errors(),
                ],
            ], 200);
        }
        $mobile        = $request->input('mobile', null);
        $old_candidate = Candidate::where('email', $request->input('email'))
            ->where(function ($q) use ($mobile) {
                if ($mobile) {
                    $q->orWhere('mobile', $mobile);
                }
            })
            ->where('id', '!=', $id)
            ->first();
        if ($old_candidate) {
            return response()->json([
                'data' => [
                    "status"  => 'duplicate_error',
                    "message" => "This mobile or email id is already present",
                ],
            ], 200);
        }
        $candidate                       = Candidate::findOrFail($id);
        $candidate->name                 = $request->input('name');
        $candidate->email                = $request->input('email');
        $candidate->mobile               = $request->input('mobile', null);
        $candidate->industry             = $request->input('industry', null);
        $candidate->job_position         = $request->input('job_position', null);
        $candidate->experience           = $request->input('experience', null);
        $candidate->gender               = $request->input('gender', null);
        $candidate->pan_no               = $request->input('pan_no', null);
        $candidate->aadhar_no            = $request->input('aadhar_no', null);
        $candidate->address              = $request->input('address', null);
        $candidate->city                 = $request->input('city', null);
        $candidate->country              = $request->input('country', null);
        $candidate->zip                  = $request->input('zip', null);
        $candidate->current_company      = $request->input('current_company', null);
        $candidate->current_job_position = $request->input('current_job_position', null);
        $candidate->current_salary       = $request->input('current_salary', null);
        $candidate->expected_salary      = $request->input('expected_salary', null);
        $candidate->expected_location    = $request->input('expected_location', null);
        $candidate->date_of_birth        = $request->input('date_of_birth', null);
        $candidate->marital_status       = $request->input('marital_status', null);
        $candidate->passport             = $request->input('passport', null);
        if ($request->hasFile('cv_file')) {
            if ($candidate->cv_file) {
                $link_array = explode('/', $candidate->cv_file);
                $file_path  = end($link_array);
                if (Storage::disk('s3')->exists('cv/' . $file_path)) {
                    Storage::disk('s3')->delete('cv/' . $file_path);
                }
            }
            $time      = Carbon::now();
            $file      = $request->file('cv_file');
            $extension = $file->getClientOriginalExtension();
            $file_name = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $disk      = Storage::disk('s3');
            $disk->putFileAs('cv', $file, $file_name);
            $file_url           = Storage::disk('s3')->url('cv/' . $file_name);
            $candidate->cv_file = $file_url;
        }

        if ($request->hasFile('cv_file_client')) {
            if ($candidate->cv_file_client) {
                $link_array = explode('/', $candidate->cv_file_client);
                $file_path  = end($link_array);
                if (Storage::disk('s3')->exists('cv/' . $file_path)) {
                    Storage::disk('s3')->delete('cv/' . $file_path);
                }
            }
            $time      = Carbon::now();
            $file      = $request->file('cv_file_client');
            $extension = $file->getClientOriginalExtension();
            $file_name = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $disk      = Storage::disk('s3');
            $disk->putFileAs('cv', $file, $file_name);
            $file_url                  = Storage::disk('s3')->url('cv/' . $file_name);
            $candidate->cv_file_client = $file_url;
        }

        $candidate->skills = $request->input('skills', null);
        $candidate->status = $request->input('status', null);
        if ($request->input('parent_code') && $request->input('parent_code') != $candidate->parent_code) {
            $candidate->parent_code   = $request->input('parent_code', null);
            $candidate->attached_on   = Carbon::now()->toDateTimeString();
            $candidate->parent_email  = $request->input('parent_email', null);
            $candidate->parent_name   = $request->input('parent_name', null);
            $candidate->parent_mobile = $request->input('parent_mobile', null);
        }
        $candidate->updated_at = Carbon::now()->toDateTimeString();
        if ($candidate->save()) {
            return response()->json([
                'data' => [
                    "status"  => 'success',
                    "message" => "Candidate has been created successfully.",
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

}
