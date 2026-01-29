<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use DB;

class CustomerController extends Controller
{
    public function createOrder(Request $request, Produk $produk)
    {

        $user = Auth::user();
        $qty = (int) $request->quantity;

        if ($produk->stok < $qty) {
            return back()->with('error', 'Stok tidak mencukupi');
        }

        DB::beginTransaction();
        try {
            $order = Order::create([
                'order_code' => 'ORD-' . Str::upper(Str::random(10)),
                'user_id' => $user->id,
                'total_amount' => $produk->harga * $qty,
                'status' => 'unpaid',
            ]);

            OrderItem::create([
                'order_id' => $order->id,
                'produk_id' => $produk->id,
                'price' => $produk->harga,
                'quantity' => $qty,
                'subtotal' => $produk->harga * $qty,
            ]);

            // stok DIKURANGI DI SINI
            $produk->decrement('stok', $qty);

            Payment::create([
                'order_id' => $order->id,
                'status' => 'INIT',
                'gross_amount' => $order->total_amount,
            ]);

            DB::commit();

            return redirect()->route('checkout.page', $order->order_code);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function checkoutPage($orderCode)
    {
        $order = Order::where('order_code', $orderCode)
            ->where('user_id', Auth::id())
            ->with('items.produk')
            ->firstOrFail();

        // Midtrans config
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $item = $order->items->first();

        $params = [
            'transaction_details' => [
                'order_id' => $order->order_code,
                'gross_amount' => (int) $order->total_amount,
            ],
            'item_details' => [
                [
                    'id' => $item->produk->id,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'name' => $item->produk->nama_produk,
                ]
            ],
            'customer_details' => [
                'first_name' => $order->user->username,
                'email' => $order->user->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('guest.pages.checkout', compact('order', 'snapToken'));
    }
}
