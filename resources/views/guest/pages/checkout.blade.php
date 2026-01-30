@php
    $item = $order->items->first();
    $produk = $item->produk;
    $qty = $item->quantity;
    $user = $order->user;
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f6f8;
        }

        .checkout-container {
            max-width: 1100px;
            margin: 60px auto;
        }

        .card {
            border: none;
            border-radius: 14px;
        }

        .product-img {
            border-radius: 12px;
            width: 100%;
            object-fit: cover;
        }

        .price {
            font-size: 22px;
            font-weight: 600;
        }

        .total {
            font-size: 26px;
            font-weight: 700;
            color: #198754;
        }

        .btn-pay {
            padding: 14px;
            font-size: 18px;
            border-radius: 10px;
        }
    </style>
</head>

<body>

    <div class="checkout-container">
        <div class="row g-4">

            <!-- KIRI: Detail Produk -->
            <div class="col-lg-7">
                <div class="card p-4 shadow-sm">
                    <h4 class="mb-4">Produk yang Dibeli</h4>

                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <img src="{{ asset('storage/' . $produk->fotoProduk->first()->file_foto_produk) }}"
                                class="product-img" alt="{{ $produk->nama_produk }}">
                        </div>
                        <div class="col-md-8">
                            <h5>{{ $produk->nama_produk }}</h5>
                            <p class="text-muted mb-1">{{ $produk->deskripsi }}</p>
                            <p class="mb-1">Harga: Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            <p class="mb-0">Jumlah: {{ $qty }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KANAN: Ringkasan & Pembayaran -->
            <div class="col-lg-5">
                <div class="card p-4 shadow-sm">
                    <h4 class="mb-4">Ringkasan Pembayaran</h4>

                    <p><strong>Nama</strong><br>{{ $user->username }}</p>
                    <p><strong>Email</strong><br>{{ $user->email }}</p>
                    <p><strong>No Telp</strong><br>{{ $user->phone ?? '-' }}</p>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <span>Biaya Layanan</span>
                        <span>Rp 0</span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between mb-4">
                        <span class="price">Total</span>
                        <span class="total">
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </span>
                    </div>

                    <button id="pay-button" class="btn btn-success btn-pay w-100">
                        <i class="fa fa-credit-card"></i> Bayar Sekarang
                    </button>
                </div>
            </div>

        </div>
    </div>

    <!-- Midtrans Snap -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <script>
        document.getElementById('pay-button').addEventListener('click', function() {
            snap.pay('{{ $snapToken }}', {
                onPending: function() {
                    window.location.href = "{{ route('payment.pending', $order->order_code) }}";
                },
                onSuccess: function() {
                    window.location.href = "{{ route('payment.success', $order->order_code) }}";
                },
                onClose: function() {
                    window.location.href = "{{ route('payment.pending', $order->order_code) }}";
                },
                onError: function() {
                    window.location.href = "{{ route('payment.failed', $order->order_code) }}";
                }
            });
        });
    </script>

</body>

</html>
