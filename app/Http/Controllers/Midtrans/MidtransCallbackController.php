<?php

namespace App\Http\Controllers\Midtrans;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;

class MidtransCallbackController extends Controller
{
    public function handle(Request $request)
    {
        Log::info('MIDTRANS CALLBACK', $request->all());

        $serverKey = config('midtrans.server_key');

        $signature = hash(
            'sha512',
            $request->order_id .
            $request->status_code .
            $request->gross_amount .
            $serverKey
        );

        if ($signature !== $request->signature_key) {
            Log::warning('Signature tidak valid');
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $order = Order::where('order_code', $request->order_id)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }
        $payment = Payment::where('order_id', $order->id)->first();

        if (!$payment) {
            $payment = Payment::create([
                'order_id' => $order->id,
                'gross_amount' => $request->gross_amount,
            ]);
        }

        $payment->update([
            'payment_type' => $request->payment_type,
            'transaction_id' => $request->transaction_id,
            'transaction_status' => $request->transaction_status,
            'status_code' => $request->status_code,
            'transaction_time' => $request->transaction_time,
        ]);

        switch ($request->transaction_status) {
            case 'capture':
            case 'settlement':
                $order->status = 'paid';
                break;

            case 'pending':
                $order->status = 'pending';
                break;

            default:
                $order->status = 'cancelled';
                break;
        }

        $order->payment_type = $request->payment_type;
        $order->transaction_status = $request->transaction_status;
        $order->save();

        return response()->json(['message' => 'Callback success']);
    }
}
