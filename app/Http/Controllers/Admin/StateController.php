<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use App\Http\Controllers\Controller;
use App\State;
use Illuminate\Http\Request;
use Validator;

class StateController extends Controller
{

    public function index(Request $request)
    {

        $keyword = $request->input("keyword", null);
        $states  = State::where(function ($query) use ($keyword) {
            if ($keyword) {
                $query->where("name", "like", "%$keyword%");
            }
        })->orderBy('id', 'desc')->paginate(20);
        return view('admin.states.list', compact('states', 'request'));
    }

    public function create()
    {
        $countries = Country::get();
        return view('admin.states.add', compact('countries'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:states,name',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    "status"  => 'validation_error',
                    "message" => $validator->errors(),
                ],
            ], 200);
        }
        $state             = new State;
        $state->name       = $request->input('name');
        $state->country_id = 1;
        if ($state->save()) {
            return response()->json([
                'data' => [
                    "status"  => 'success',
                    "message" => "State has been created successfully.",
                ],
            ], 200);
        } else {
            return response()->json([
                'data' => [
                    "status"  => 'error',
                    "message" => "Sorry a problem occurred while creating the State.",
                ],
            ], 200);
        }
    }

    public function edit($id)
    {
        $countries = Country::get();
        $state     = State::findOrFail($id);
        return view('admin.states.edit', compact('countries', 'state'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:states,name,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    "status"  => 'validation_error',
                    "message" => $validator->errors(),
                ],
            ], 200);
        }

        $state             = State::findOrFail($id);
        $state->name       = $request->input('name');
        $state->country_id = 1;

        if ($state->save()) {
            return response()->json([
                'data' => [
                    "status"  => 'success',
                    "message" => "State has been updated successfully.",
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
        $state = State::findOrFail($id);
        if ($state) {

            $state->delete();
            return response()->json([
                'success' => [
                    'message' => "State has been removed",
                ],
            ], 200);
        } else {
            return response()->json([
                'error' => [
                    'message' => "State Not Found",
                ],
            ], 200);
        }
    }

}
