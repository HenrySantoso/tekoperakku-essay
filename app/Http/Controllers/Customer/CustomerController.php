<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function checkout(Request $request, Produk $produk)
    {
        $user = Auth::user();
        $quantity = $request->quantity;

        // Midtrans config
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . Str::uuid(),
                'gross_amount' => $produk->harga * $quantity,
            ],
            'item_details' => [
                [
                    'id' => $produk->id,
                    'price' => $produk->harga,
                    'quantity' => $quantity,
                    'name' => $produk->nama_produk,
                ]
            ],
            'customer_details' => [
                'first_name' => $user->username ?? 'Customer',
                'email' => $user->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('guest.pages.checkout', compact(
            'produk',
            'user',
            'quantity',
            'snapToken'
        ));
    }
}
