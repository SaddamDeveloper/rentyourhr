<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;

class UserController extends Controller
{
    public function index($type = null, Request $request)
    {
        $keyword = $request->input('keyword', null);
        $data    = User::orderBy('updated_at', 'DESC')
            ->where(function ($q) use ($type) {
                if ($type === 'active') {
                    $q->where('status', 1);
                }
                if ($type === 'archived') {
                    $q->where('status', 0);
                }
            })
            ->where(function ($q) use ($keyword) {
                if ($keyword) {
                    $q->orWhere('name', 'LIKE', '%' . $keyword . '%');
                    $q->orWhere('email', 'LIKE', '%' . $keyword . '%');
                    $q->orWhere('mobile', 'LIKE', '%' . $keyword . '%');
                    $q->orWhere('address', 'LIKE', '%' . $keyword . '%');
                    $q->orWhere('location', 'LIKE', '%' . $keyword . '%');
                    $q->orWhere('user_code', 'LIKE', '%' . $keyword . '%');
                }
            })
            ->with('roles')
            ->paginate(15);
        return view('admin.users.list', compact('data', 'request'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.add', compact('roles'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'         => 'required|string',
            'email'        => 'required|email|unique:users,email',
            'mobile'       => 'nullable|numeric|digits_between:10,10|unique:users,mobile',
            'company_name' => 'required|string',
            'address'      => 'nullable|string',
            'location'     => 'nullable|string',
            'roles'        => 'required|array|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    "status"  => 'validation_error',
                    "message" => $validator->errors(),
                ],
            ], 200);
        }
        $user                 = new User();
        $user->name           = $request->input('name');
        $user->email          = $request->input('email');
        $user->mobile         = $request->input('mobile', null);
        $user->user_code      = 'RGB' . rand(100, 999) . date("his");
        $user->address        = $request->input('address', null);
        $user->company_name   = $request->input('company_name', null);
        $user->location       = $request->input('location', null);
        $user->password       = bcrypt('password');
        $user->remember_token = Str::random(10);
        $res                  = $user->save();
        //Add Role To the User
        $roles = $request->roles;
        $user->syncRoles($roles);
        if ($res) {
            return response()->json([
                'data' => [
                    "status"  => 'success',
                    "message" => "User has been created successfully.",
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
        $user  = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'         => 'required|string',
            'email'        => 'required|email|unique:users,email,' . $id,
            'mobile'       => 'nullable|numeric|digits_between:10,10|unique:users,mobile,' . $id,
            'company_name' => 'required|string',
            'address'      => 'nullable|string',
            'location'     => 'nullable|string',
            'roles'        => 'required|array|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    "status"  => 'validation_error',
                    "message" => $validator->errors(),
                ],
            ], 200);
        }
        $user               = User::findOrFail($id);
        $user->name         = $request->input('name');
        $user->email        = $request->input('email');
        $user->mobile       = $request->input('mobile', null);
        $user->company_name = $request->input('company_name', null);
        $user->address      = $request->input('address', null);
        $user->location     = $request->input('location', null);
        $user->updated_at   = Carbon::now()->toDateTimeString();
        $res                = $user->save();
        //Add Role To the User
        $roles = $request->roles;
        $user->syncRoles($roles);
        if ($res) {
            return response()->json([
                'data' => [
                    "status"  => 'success',
                    "message" => "User has been updated successfully.",
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

    public function show($user_id)
    {
        $user = User::where('id', $user_id)
            ->with('roles')
            ->first();
        return view('admin.users.show', compact('user'));
    }

    public function change_status(Request $request)
    {
        $res = User::where('id', $request->id)
            ->update([
                'status' => $request->status,
            ]);
        $message = ($request->status) ? "Restored" : "Archived";
        if ($res) {
            return response()->json([
                'success' => [
                    'message' => "User has been " . $message,
                ],
            ], 200);
        } else {
            return response()->json([
                'error' => [
                    'message' => "Record not Found",
                ],
            ], 200);
        }
    }

}
