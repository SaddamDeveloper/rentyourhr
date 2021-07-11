<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Permission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $keyword     = $request->input('keyword', null);
        $permissions = Permission::orderBy('updated_at', 'ASC')
            ->where(function ($q) use ($keyword) {
                if ($keyword) {
                    $q->orWhere('display_name', 'LIKE', '%' . $keyword . '%');
                    $q->orWhere('name', 'LIKE', '%' . $keyword . '%');
                    $q->orWhere('description', 'LIKE', '%' . $keyword . '%');
                }
            })
            ->paginate(15);
        return view('admin.permissions.index', compact('permissions', 'request'));
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'permission_type' => 'required',
        ];
        if ($request->permission_type == "basic") {
            $rules['display_name'] = 'required';
            $rules['description']  = 'required';
        } else {
            $rules['resource']      = 'required';
            $rules['curd_selected'] = 'required';
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    "status"  => 'validation_error',
                    "message" => $validator->errors(),
                ],
            ], 200);
        }
        if ($request->permission_type == 'basic') {
            $permission               = new Permission();
            $permission->display_name = $request->input('display_name');
            $permission->name         = Str::slug($request->input('display_name'), '_');
            $permission->description  = $request->input('description', null);
            if ($permission->save()) {
                return response()->json([
                    'data' => [
                        "status"  => 'success',
                        "message" => "Permission has been created successfully.",
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
        } else {
            foreach ($request->curd_selected as $x) {
                $display_name             = ucfirst($x) . ' ' . ucfirst($request->resource);
                $name                     = strtolower($x) . '_' . strtolower(Str::slug($request->resource, '_'));
                $description              = "Allows a user to " . strtolower($x) . ' a ' . ucwords($request->resource);
                $permission               = new Permission();
                $permission->display_name = $display_name;
                $permission->name         = $name;
                $permission->description  = $description;
                $permission->save();
            }
            return response()->json([
                'data' => [
                    "status"  => 'success',
                    "message" => "Permission has been created successfully.",
                ],
            ], 200);

        }
    }

    public function edit($id)
    {
        $permission = Permission::where('id', $id)->firstOrFail();
        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'         => 'required|string|unique:permissions,name,' . $id,
            'display_name' => 'required',
            'description'  => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    "status"  => 'validation_error',
                    "message" => $validator->errors(),
                ],
            ], 200);
        }
        $permission               = Permission::findOrFail($id);
        $permission->name         = $request->input('name', null);
        $permission->display_name = $request->input('display_name', null);
        $permission->description  = $request->input('description', null);
        $permission->updated_at   = Carbon::now()->toDateTimeString();
        $res                      = $permission->save();
        if ($res) {
            return response()->json([
                'data' => [
                    "status"  => 'success',
                    "message" => "Permission has been created successfully.",
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
        $permission = Permission::findOrFail($id);
        $res        = $permission->delete();
        if ($res) {
            return response()->json([
                'success' => [
                    'message' => "Permission " . $permission->display_name . " has been Removed",
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
