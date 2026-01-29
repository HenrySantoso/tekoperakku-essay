<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Menunggu Pembayaran</title>
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
                Pembayaran kamu belum selesai. Silakan selesaikan pembayaran sesuai metode yang dipilih.
            </p>

            <div class="alert alert-warning text-start">
                <i class="fa fa-info-circle"></i>
                Transaksi akan otomatis dibatalkan jika tidak diselesaikan sebelum batas waktu.
            </div>

            <div class="d-grid gap-2">
                <a href="{{ route('checkout') }}" class="btn btn-primary">
                    Lanjutkan Pembayaran
                </a>
                <a href="{{ route('products') }}" class="btn btn-outline-secondary">
                    Kembali ke Produk
                </a>
            </div>

        </div>
    </div>
</div>

</body>
</html>
