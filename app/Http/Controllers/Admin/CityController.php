<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\Http\Controllers\Controller;
use App\State;
use Illuminate\Http\Request;
use Validator;

class CityController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->input("keyword", null);
        $cities  = City::where(function ($query) use ($keyword) {
            if ($keyword) {
                $query->where("name", "like", "%" . $keyword . "%");
            }

        })->with("state.country")->orderBy('id', 'asc')->paginate(20);
        return view('admin.cities.list', compact('cities', 'request'));
    }

    public function create()
    {
        $states = State::with("country")->get();
        return view('admin.cities.add', compact('states'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|unique:cities,name',
            'state_id' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    "status"  => 'validation_error',
                    "message" => $validator->errors(),
                ],
            ], 200);
        }

        $city           = new City;
        $city->name     = $request->input('name');
        $city->state_id = $request->input('state_id');
        if ($city->save()) {
            return response()->json([
                'data' => [
                    "status"  => 'success',
                    "message" => "City has been created successfully.",
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
        $city   = City::findOrFail($id);
        $states = State::with("country")->get();
        return view('admin.cities.edit', compact('city', 'states'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|unique:cities,name,' . $id,
            'state_id' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    "status"  => 'validation_error',
                    "message" => $validator->errors(),
                ],
            ], 200);
        }

        $city           = City::findOrFail($id);
        $city->name     = $request->input('name');
        $city->state_id = $request->input('state_id');
        if ($city->save()) {
            return response()->json([
                'data' => [
                    "status"  => 'success',
                    "message" => "City has been updated successfully.",
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
        $city = City::findOrFail($id);
        if ($city) {
            $city->delete();
            return response()->json([
                'success' => [
                    'message' => "City has been removed",
                ],
            ], 200);
        } else {
            return response()->json([
                'error' => [
                    'message' => "City Not Found",
                ],
            ], 200);
        }
    }

}
