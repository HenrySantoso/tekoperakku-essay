<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class PaymentController extends Controller
{
    public function callback(Request $request)
    {
        $order = Order::where('order_code', $request->order_id)->first();

        $status = $request->transaction_status;

        if ($status == 'settlement') {
            $order->update(['status' => 'PAID']);
        } elseif ($status == 'pending') {
            $order->update(['status' => 'PENDING']);
        } else {
            $order->update(['status' => 'FAILED']);

            // balikin stok
            foreach ($order->items as $item) {
                $item->produk->increment('stok', $item->quantity);
            }
        }

        $order->payment->update([
            'payment_type' => $request->payment_type,
            'transaction_id' => $request->transaction_id,
            'status' => $status,
            'response_json' => json_encode($request->all()),
        ]);
    }

}
