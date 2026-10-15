<?php
$courseName ='Laravel Fundamental';
$fee = 350000;
$participantCount = 2;
$discountPercent = 10;
$adminFee = 25000;
$isActive = true;

$subtotal = $fee * $participantCount;
$discount = intdiv($subtotal * $discountPercent, 100);
$total = $subtotal - $discount + $adminFee;
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kalkulator Biaya KursusKu</title>
    <style>
        body {
        font-family: Arial, sans-serif;
        background: #f3e8ff;
        margin: 0;
        padding: 32px;
        color: #3b0764;
    }

    .card {
        max-width: 720px;
        margin: auto;
        background: #ffffff;
        padding: 28px;
        border-radius: 18px;
        box-shadow: 0 8px 25px rgba(88, 28, 135, 0.15);
    }

    h1 {
        color: #6b21a8;
        margin-top: 12px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        border-bottom: 1px solid #e9d5ff;
        padding: 12px 10px;
        text-align: left;
    }

    th {
        background: #faf5ff;
        color: #581c87;
    }

    tr:hover {
        background: #faf5ff;
    }

    .total {
        background: #7e22ce;
        color: #ffffff;
        font-weight: bold;
    }

    .total td {
        border-bottom: none;
    }

    a {
        color: #9333ea;
        font-weight: bold;
        text-decoration: none;
    }

    a:hover {
        color: #581c87;
        text-decoration: underline;
    }
    </style>
</head>
<body>
    <main class="card">
    <h1>Kalkulator Estimasi Biaya</h1>
    <p>Kursus: <strong><?= $courseName ?></strong></p>

    <table>
        <tr><th>Komponen</th><th>Nilai</th></tr>
        <tr><td>Biaya per peserta</td><td>Rp <?= number_format($fee, 0,',','.') ?></td></tr>
    <tr><td>Jumlah peserta</td><td><?= $participantCount ?></td></tr>
    <tr><td>Subtotal</td><td>Rp <?= number_format($subtotal, 0, ', ','.') ?></td></tr>
    <tr><td>Diskon (<?= $discountPercent ?>%)</td><td>- Rp <?=
number_format($discount,0,',',',') ?></td></tr>
    <tr><td>Biaya admin</td><td>Rp <?= number_format($adminFee, 0, ', ','.') ?></td></tr>
    <tr class="total"><td>Total akhir</td><td>Rp <?= number_format($total,0,',','.') ?></
td></tr>
    </table>
<p><a href="index.php">Kembali ke Beranda Kursusku</a></p>
    </main>
</body>
</html>