<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request, $type = null)
    {
        $keyword = $request->input('keyword', null);
        $data    = OrderItem::orderBy('updated_at', 'DESC')
            ->with('order.user')
            ->paginate(10);
        return view('admin.orders.list', compact('data', 'request'));
    }

    public function show($id)
    {
        $order = OrderItem::where('id', $id)
            ->first();
        return view('admin.orders.show', compact('order'));
    }

    public function status(Request $request)
    {
        $order = OrderItem::where('id', $request->input('id'))->first();
        if ($order) {
            $order->status = $request->input('status');
            $order->save();
            return response()->json([
                'success' => [
                    'message' => "Order status has been Updated",
                ],
            ], 200);
        } else {
            return response()->json([
                'error' => [
                    'message' => "Order status Not Found",
                ],
            ], 200);
        }
    }

    public function destroy($id)
    {
        $job = OrderItem::findOrFail($id);
        if ($job) {
            $job->delete();
            return response()->json([
                'success' => [
                    'message' => "Order has been removed",
                ],
            ], 200);
        } else {
            return response()->json([
                'error' => [
                    'message' => "Job Profile Not Found",
                ],
            ], 200);
        }
    }

}
