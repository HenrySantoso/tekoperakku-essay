<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran Berhasil</title>
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
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="col-md-6">
        <div class="card p-5 text-center shadow-sm">

            <i class="fa fa-circle-check icon-success mb-3"></i>

            <h3 class="mb-2">Pembayaran Berhasil</h3>
            <p class="text-muted mb-4">
                Terima kasih! Pembayaran kamu telah berhasil diproses.
            </p>

            <div class="d-grid gap-2">
                <a href="{{ route('guest-index') }}" class="btn btn-outline-secondary">
                    Ke Beranda
                </a>
            </div>

        </div>
    </div>
</div>

</body>
</html>
