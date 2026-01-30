<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Menunggu Pembayaran</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    {{-- Midtrans Snap --}}
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

        .icon-pending {
            font-size: 64px;
            color: #f0ad4e;
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-6">
            <div class="card p-5 text-center shadow-sm">

                <i class="fa fa-clock icon-pending mb-3"></i>

                <h3 class="mb-2">Menunggu Pembayaran</h3>
                <p class="text-muted mb-4">
                    Pesanan <strong>{{ $order->order_code }}</strong> belum selesai dibayar.
                </p>

                <div class="alert alert-warning text-start">
                    <i class="fa fa-info-circle"></i>
                    Silakan selesaikan pembayaran sebelum waktu berakhir.
                </div>

                <div class="d-grid gap-2">
                    @if ($payment && $payment->snap_token)
                        <button id="pay-again" class="btn btn-primary">
                            Lanjutkan Pembayaran
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
            document.getElementById('pay-again').addEventListener('click', function() {
                snap.pay('{{ $payment->snap_token }}');
            });
        </script>
    @endif

</body>

</html>
