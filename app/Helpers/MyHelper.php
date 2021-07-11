<?php

namespace App\Helpers;

use App\Order;
use App\TemporaryOrder;
use App\User;
use Illuminate\Support\Facades\Auth;

class MyHelper
{
    public static function loadCart()
    {
        if (Auth::check()) {
            return $cart = TemporaryOrder::where('user_id', Auth::user()->id)
                ->count();
        } else {
            return 0;
        }
    }
    public static function UnPaidInvoiceStatus()
    {
        if (Auth::check()) {
            return $cart = Order::where('user_id', Auth::user()->id)
                ->where('status', '=', 'pending')
                ->count();
        } else {
            return 0;
        }
    }
}
