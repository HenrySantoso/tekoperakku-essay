<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pembayaran Gagal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    {{-- Midtrans Snap (untuk retry) --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <style>
        body {
            background: #f5f6f8;
        }

        .card {
            border: none;
            border-radius: 16px;
        }

        .icon-failed {
            font-size: 64px;
            color: #dc3545;
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-6">
            <div class="card p-5 text-center shadow-sm">

                <i class="fa fa-circle-xmark icon-failed mb-3"></i>

                <h3 class="mb-2">Pembayaran Gagal</h3>
                <p class="text-muted mb-4">
                    Pembayaran untuk pesanan <strong>{{ $order->order_code }}</strong> tidak berhasil diselesaikan.
                </p>

                <div class="alert alert-danger text-start">
                    <i class="fa fa-info-circle"></i>
                    @if ($payment && $payment->transaction_status)
                        Status: <strong>{{ strtoupper($payment->transaction_status) }}</strong>
                    @else
                        Terjadi pembatalan atau kegagalan pembayaran.
                    @endif
                </div>

                <div class="d-grid gap-2">
                    @if ($payment && $payment->snap_token && in_array($order->status, ['pending', 'cancelled']))
                        <button id="retry-payment" class="btn btn-danger">
                            Coba Bayar Lagi
                        </button>
                    @endif

                    <a href="{{ route('guest-katalog') }}" class="btn btn-outline-secondary">
                        Kembali ke Produk
                    </a>
                </div>

            </div>
        </div>
    </div>

    @if ($payment && $payment->snap_token)
        <script>
            document.getElementById('retry-payment')?.addEventListener('click', function() {
                snap.pay('{{ $payment->snap_token }}');
            });
        </script>
    @endif

</body>

</html>
