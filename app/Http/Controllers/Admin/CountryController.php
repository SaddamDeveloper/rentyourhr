<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CountryController extends Controller
{

    public function index(Request $request)
    {
        $countries = Country::orderBy('name', 'desc')
           ->get();
        return view('admin.countries.list', compact('countries', 'request'));
    }


    public function create()
    {
        return view('admin.countries.add');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|unique:countries,name',
            'code'     => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    "status"  => 'validation_error',
                    "message" => $validator->errors(),
                ],
            ], 200);
        }

        $country            = new Country;
        $country->name      = $request->input('name');
        $country->code      = $request->input('code');

        if ($country->save()) {
            return response()->json([
                'data' => [
                    "status"  => 'success',
                    "message" => "Country has been added successfully.",
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
        $country = Country::findOrFail($id);
        return view('admin.countries.edit', compact('country'));
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|unique:countries,name,' . $id,
            'code'     => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    "status"  => 'validation_error',
                    "message" => $validator->errors(),
                ],
            ], 200);
        }

        $country            = Country::findOrFail($id);
        $country->name      = $request->input('name');
        $country->code      = $request->input('code');
        $country->save();
        if ($country->save()) {
            return response()->json([
                'data' => [
                    "status"  => 'success',
                    "message" => "Country has been updated successfully.",
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

        $country = Country::findOrFail($id);
        if ($country) {
            LogHelper::addToLog(Auth::user()->id, "Country", "Delete a Country " . $country->name);
            $country->delete();
            return response()->json([
                'success' => [
                    'message' => "Country has been removed",
                ],
            ], 200);
        } else {
            return response()->json([
                'error' => [
                    'message' => "Country Not Found",
                ],
            ], 200);
        }
    }
}
