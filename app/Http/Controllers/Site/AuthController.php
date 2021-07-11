<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\SmsVerification;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Validator;

class AuthController extends Controller
{
    public function joinus()
    {
        if (Auth::check()) {
            return redirect()->route('welcome');
        } else {
            return view('site.auth.joinus');
        }
    }

    public function otp(Request $request)
    {
        $rules = [
            'contact_number' => 'required|regex:/[0-9]{10}/|digits:10',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->getMessageBag()->toArray())->withInput($request->input());
        }
        $code           = mt_rand(1000, 9999);
        $contact_number = $request->input('contact_number');
        $otp            = SmsVerification::firstOrNew([
            'contact_number' => $contact_number,
        ]);
        if ($otp->resend <= 2) {
            $otp->code   = $code;
            $otp->resend = ($otp->resend + 1);
            $otp->save();
            return view('site.auth.otp', compact('otp'));
        } else {
            $otp->delete();
            return Redirect::back()->withErrors([
                'contact_number' => "Max Request Limit Reached",
            ])->withInput($request->input());
        }
    }

    public function verifyLogin(Request $request)
    {
        $rules = [
            'contact_number' => 'required|regex:/[0-9]{10}/|digits:10',
            'code'           => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    "status"  => 'error',
                    "message" => "Wrong Mobile Number Or OTP",
                ],
            ], 200);
        }
        $contact_number = $request->input('contact_number', null);
        $code           = $request->input('code', null);
        $verify         = SmsVerification::where('contact_number', $contact_number)
            ->where('updated_at', '>', Carbon::now()->subMinutes(5))
            ->where('code', $code)
            ->first();
        if ($verify) {
            $verify->delete();
            $login = $this->doLogin($contact_number);
            if ($login) {
                $user = User::where('id', Auth::user()->id)
                    ->first();
                Auth::setUser($user);
                return response()->json([
                    'data' => [
                        "status"  => 'success',
                        "message" => "Success",
                        "user"    => Auth::user(),
                    ],
                ], 200);
            } else {
                return response()->json([
                    'data' => [
                        "status"  => 'error',
                        "message" => "Wrong Mobile Number Or OTP",
                    ],
                ], 200);
            }
        } else {
            return response()->json([
                'data' => [
                    "status"  => 'error',
                    "message" => "Wrong Mobile Number Or OTP",
                ],
            ], 200);
        }
    }

    private function doLogin($mobile)
    {
        $user = User::where('mobile', $mobile)
            ->where('status', true)
            ->first();
        if ($user) {
            Auth::login($user);
            return $user = Auth::user();
        } else {
            $password              = date("his");
            $user                  = new User();
            $user->mobile          = $mobile;
            $user->user_code       = 'RGB' . rand(100, 999) . date("his");
            $user->password        = bcrypt($password);
            $user->mobile_verified = 1;
            $user->remember_token  = Str::random(10);
            $res                   = $user->save();
            $user->syncRoles([2]);
            if ($res) {
                Auth::login($user);
                return $user = Auth::user();
            } else {
                return 0;
            }
        }
    }

    public function logout(Request $request, Guard $guard)
    {
        $guard->logout();
        $request->session()->invalidate();
        return redirect()->route('welcome');
    }
}
