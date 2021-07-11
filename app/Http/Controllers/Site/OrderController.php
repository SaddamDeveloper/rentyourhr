<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderItem;
use App\Package;
use App\TemporaryOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class OrderController extends Controller
{
    public function products(Request $request)
    {
        return view('site.order.product');
    }

    public function addToCart(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'job_profile_id' => 'required',
            'package_id'     => 'required',
            'quantity'       => 'required|numeric',
            'address'        => 'required',
            'state'          => 'required',
            'city'           => 'required',
            'zip'            => 'required',
            'gst_number'     => 'required',
            'min_salary'     => 'required|numeric',
            'max_salary'     => 'required|numeric',
            'experience'     => 'required|string',
            'description'    => 'nullable|string',
            'total'          => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    "status"  => 'validation_error',
                    "message" => $validator->errors(),
                ],
            ], 200);
        }
        $package = Package::where('id', $request->input('package_id'))
            ->first();
        if ($package) {
            $quantity    = (int) $request->input('quantity', 1);
            $bill_amount = ($package->amount * $quantity);
            $cgst        = (($bill_amount * env('CGST')) / 100);
            $sgst        = (($bill_amount * env('SGST')) / 100);
            if ($request->input('state') === "West Bengal") {
                $igst = 0;
            } else {
                $igst = (($bill_amount * env('SGST')) / 100);
            }
            $temp_order_item                 = new TemporaryOrder();
            $temp_order_item->user_id        = Auth::user()->id;
            $temp_order_item->job_profile_id = $package->job_profile_id;
            $temp_order_item->package_id     = $package->id;
            $temp_order_item->price          = $package->amount;
            $temp_order_item->quantity       = $quantity;
            $temp_order_item->min_salary     = $request->input('min_salary');
            $temp_order_item->max_salary     = $request->input('max_salary');
            $temp_order_item->amount         = $bill_amount;
            $temp_order_item->experience     = $request->input('experience');
            $temp_order_item->description    = $request->input('description');
            $temp_order_item->address        = $request->input('address');
            $temp_order_item->state          = $request->input('state');
            $temp_order_item->city           = $request->input('city');
            $temp_order_item->zip            = $request->input('zip');
            $temp_order_item->gst_number     = $request->input('gst_number');
            $temp_order_item->cgst           = $cgst;
            $temp_order_item->sgst           = $sgst;
            $temp_order_item->igst           = $igst;
            $temp_order_item->total          = ($bill_amount + $cgst + $sgst + $igst);
            if ($temp_order_item->save()) {
                return response()->json([
                    'data' => [
                        "status"  => 'success',
                        "message" => "Order has been placed successfully.",
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
            return response()->json([
                'data' => [
                    "status"  => 'error',
                    "message" => "Sorry a problem has occurred.",
                ],
            ], 200);
        }
    }

    public function checkoutList(Request $request)
    {
        $user_id = Auth::user()->id;
        $data    = TemporaryOrder::where('user_id', $user_id)
            ->with('position', 'package')
            ->get();
        return view('site.order.checkout', compact('data'));

    }

    public function removeJob($id)
    {
        $temp_order_item = TemporaryOrder::findOrFail($id);
        if ($temp_order_item) {
            $temp_order_item->delete();
            return response()->json([
                'success' => [
                    'message' => "Job profile has been removed",
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

    public function jobPlaceOrder(Request $request)
    {
        $user_id   = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'company'     => 'required|string',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    "status"  => 'validation_error',
                    "message" => $validator->errors(),
                ],
            ], 200);
        }
        $temp_data    = TemporaryOrder::where('user_id', $user_id)->get();
        $total_amount = 0;
        $bill_total   = 0;
        $igst_total   = 0;
        $cgst_total   = 0;
        $sgst_total   = 0;
        $gst_total    = 0;
        foreach ($temp_data as $key => $value) {
            $total_amount += $value->amount;
            $bill_total += $value->total;
            $igst_total += $value->igst;
            $cgst_total += $value->cgst;
            $sgst_total += $value->sgst;
        }
        $gst_total           = ($sgst_total + $cgst_total + $igst_total);
        $order               = new Order;
        $order->user_id      = Auth::user()->id;
        $order->order_id     = 'ryhri' . rand(100, 999) . date("his");
        $order->company      = $request->input('company');
        $order->description  = $request->input('description');
        $order->total_amount = $total_amount;
        $order->gst          = $gst_total;
        $order->bill_total   = $bill_total;
        $order->status       = 'pending';
        if ($order->save()) {

            foreach ($temp_data as $key => $e) {
                $order_item                 = new OrderItem();
                $order_item->order_id       = $order->id;
                $order_item->job_profile_id = $e->job_profile_id;
                $order_item->package_id     = $e->package_id;
                $order_item->price          = $e->price;
                $order_item->quantity       = $e->quantity;
                $order_item->experience     = $e->experience;
                $order_item->min_salary     = $e->min_salary;
                $order_item->max_salary     = $e->max_salary;
                $order_item->description    = $e->description;
                $order_item->amount         = $e->amount;
                $order_item->address        = $e->address;
                $order_item->state          = $e->state;
                $order_item->city           = $e->city;
                $order_item->zip            = $e->zip;
                $order_item->gst_number     = $e->gst_number;
                $order_item->cgst           = $e->cgst;
                $order_item->sgst           = $e->sgst;
                $order_item->igst           = $e->igst;
                $order_item->total          = $e->total;
                $order_item->status         = 'order_placed';
                $order_item->save();
            }
            TemporaryOrder::where('user_id', $user_id)->delete();

            return response()->json([
                'data' => [
                    "status"  => 'success',
                    "message" => "Order has been placed successfully.",
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

    public function unPaidInvoice()
    {
        $user_id = Auth::user()->id;
        $orders  = Order::where('user_id', $user_id)
            ->with('items')
            ->where('status', '=', 'pending')
            ->get();
        return view('site.invoice.un_paid_invoice', compact('orders'));
    }

    public function PayNow($order_id)
    {
        $user_id = Auth::user()->id;
        $orders  = Order::where('order_id', $order_id)
            ->with('items')
            ->where('status', '=', 'pending')
            ->first();
        return view('site.invoice.payment', compact('orders'));
    }
}
