<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Tidak Ditemukan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .error-container {
            margin-top: 5%;
        }
        .error-icon {
            font-size: 60px;
            color: #dc3545;
        }
        .sad-pixel {
            width: 150px;
            height: auto;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container text-center error-container">
        <img src="<?= base_url('assets/images/error.png'); ?>" alt="Sad Face Pixel Art" class="sad-pixel">

        <p class="lead">Data yang Anda cari tidak ditemukan atau tidak tersedia.</p>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>
</html>
