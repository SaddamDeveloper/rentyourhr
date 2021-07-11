<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\State;
use App\User;
use App\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class ProfileController extends Controller
{
    public function profile()
    {
        $user_id = Auth::user()->id;
        $user    = User::where('id', $user_id)->first();
        $states  = State::where('country_id', 1)
            ->orderBy('name', 'ASC')
            ->select('id', 'name')
            ->get();
        $user_address = UserAddress::where('user_id', $user_id)->get();
        return view('site.auth.profile', compact('user', 'user_address', 'states'));
    }

    public function addressStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'    => 'required',
            'address' => 'required',
            'state'   => 'required',
            'city'    => 'required',
            'zip'     => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    "status"  => 'validation_error',
                    "message" => $validator->errors(),
                ],
            ], 200);
        }
        $user_add          = new UserAddress();
        $user_id           = Auth::user()->id;
        $user_add->user_id = $user_id;
        $user_add->name    = $request->input('name');
        $user_add->address = $request->input('address');
        $user_add->state   = $request->input('state');
        $user_add->city    = $request->input('city');
        $user_add->zip     = $request->input('zip');
        if ($user_add->save()) {
            $html = '<tr>
                <th scope="row">' . $user_add->name . '</th>
                <th scope="row">' . $user_add->address . '</th>
                <th scope="row">' . $user_add->city . ' - ' . $user_add->zip . '</th>
                <th scope="row">' . $user_add->state . '</th>
                <td>
                    <a href="' . route('address.remove', $user_add->id) . '" data-method="delete" class="delete-address">
                        <i class="fa fa-trash fa-2x text-danger"></i>
                    </a>
                </td>
            </tr>';
            return response()->json([
                'data' => [
                    "status"  => 'success',
                    "message" => "Address has been add successfully.",
                    "html"    => $html,
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

    public function removeAddress($id)
    {
        $user_add = UserAddress::findOrFail($id);
        if ($user_add) {
            $user_add->delete();
            return response()->json([
                'success' => [
                    'message' => "Address has been removed",
                ],
            ], 200);
        } else {
            return response()->json([
                'error' => [
                    'message' => "Sorry a problem has occurred",
                ],
            ], 200);
        }
    }
    public function profileUpdate()
    {
        $user_id = Auth::user()->id;
        $user    = User::where('id', $user_id)->first();
        return view('site.auth.profile_update', compact('user'));
    }

    public function profileSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'         => 'required',
            'email'        => 'required|email|unique:users,email,' . Auth::user()->id,
            'company_name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    "status"  => 'validation_error',
                    "message" => $validator->errors(),
                ],
            ], 200);
        }
        $user_id            = Auth::user()->id;
        $user               = User::where('id', $user_id)->first();
        $user->name         = $request->input('name');
        $user->email        = $request->input('email');
        $user->company_name = $request->input('company_name');
        $user->is_complete  = 1;
        if ($user->save()) {
            return response()->json([
                'data' => [
                    "status"  => 'success',
                    "message" => "You updated your details.",
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
