<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserIsComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->is_complete===0) {
                $notification = array(
                    'message'    => 'Please complete your profile.',
                    'alert-type' => 'error',
                );
                return redirect()->route('profile.update')->with($notification);
            } else {
                return $next($request);
            }

        }else{
            return $next($request);
        }
    }
}
