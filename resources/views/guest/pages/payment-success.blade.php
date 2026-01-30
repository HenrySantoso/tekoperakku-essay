<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pembayaran</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f6f8;
        }

        .card {
            border: none;
            border-radius: 16px;
        }

        .icon-success {
            font-size: 64px;
            color: #198754;
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

                @if ($order->status === 'paid')
                    {{-- SUCCESS --}}
                    <i class="fa fa-circle-check icon-success mb-3"></i>

                    <h3 class="mb-2">Pembayaran Berhasil</h3>
                    <p class="text-muted mb-3">
                        Pesanan <strong>{{ $order->order_code }}</strong> telah berhasil dibayar.
                    </p>

                    <ul class="list-group text-start mb-4">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total</span>
                            <strong>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Metode Pembayaran</span>
                            <strong>{{ strtoupper($payment->payment_type ?? '-') }}</strong>
                        </li>
                    </ul>

                    <a href="{{ route('guest-index') }}" class="btn btn-success w-100">
                        Ke Beranda
                    </a>
                @else
                    {{-- MASIH PENDING --}}
                    <i class="fa fa-clock icon-pending mb-3"></i>

                    <h3 class="mb-2">Pembayaran Sedang Diproses</h3>
                    <p class="text-muted mb-4">
                        Kami sedang menunggu konfirmasi pembayaran untuk pesanan
                        <strong>{{ $order->order_code }}</strong>.
                    </p>

                    <div class="d-grid gap-2">
                        <a href="{{ route('payment.pending', $order->order_code) }}" class="btn btn-warning">
                            Lihat Status Pembayaran
                        </a>
                        <a href="{{ route('guest-index') }}" class="btn btn-outline-secondary">
                            Ke Beranda
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>

</body>

</html>
