<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        } else {
            return view('admin.auth.login');
        }
    }

    public function doLogin(Request $request, Guard $guard)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    "status"  => 'validation_error',
                    "message" => $validator->errors(),
                ],
            ], 200);
        } else {
            $credentials = array(
                'email' => $request->input('email'),
                'password'  => $request->input('password'),
                'status'    => true,
            );
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                if ($user->hasRole(['admin', 'superadmin'])) {
                    return response()->json([
                        'data' => [
                            "status"  => 'success',
                            "message" => "Login success",
                        ],
                    ], 200);

                } else {
                    $guard->logout();
                    $request->session()->invalidate();
                    return response()->json([
                        'data' => [
                            "status"  => 'error',
                            "message" => "Please insert a valid credential.",
                        ],
                    ], 200);
                }
            } else {
                return response()->json([
                    'data' => [
                        "status"  => 'error',
                        "message" => "Please insert a valid credential.",
                    ],
                ], 200);
            }
        }
    }

    public function logout(Request $request, Guard $guard)
    {
        $guard->logout();
        $request->session()->invalidate();
        return redirect()->route('admin.login');
    }
}
