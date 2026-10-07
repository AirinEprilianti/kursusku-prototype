<?php

session_start();

require __DIR__ . '/helpers.php';

$history = [
    ['name' => 'Alya',  'course' => 'Web Dasar',      'total' => 240000],
    ['name' => 'Bima',  'course' => 'PHP Dasar',      'total' => 340000],
    ['name' => 'Citra', 'course' => 'Laravel Dasar',  'total' => 500000],
];

// Tambahkan data pendaftar baru dari session
if (isset($_SESSION['history']) && is_array($_SESSION['history'])) {

    foreach ($_SESSION['history'] as $item) {
        $history[] = $item;
    }

}
?>

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>History Pendaftaran - KursusKu UIN</title>

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(
                135deg,
                #f8f7ff,
                #eeeaff
            );
            color: #29254a;
            min-height: 100vh;
        }

        /* =========================
           HEADER
        ========================== */

        header {
            background: #ffffff;
            border-bottom: 1px solid #eeeafd;
            box-shadow: 0 3px 15px rgba(76, 63, 150, 0.06);
        }

        .navbar {
            max-width: 1400px;
            margin: auto;
            padding: 24px 40px;

            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
        }

        .brand {
            color: #6652e8;
            font-size: 30px;
            font-weight: 800;
            text-decoration: none;
            white-space: nowrap;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .nav-menu a {
            text-decoration: none;
            color: #514b70;
            font-size: 16px;
            font-weight: 600;

            padding: 12px 18px;
            border-radius: 12px;

            transition: 0.2s;
        }

        .nav-menu a:hover {
            background: #f0edff;
            color: #624ee5;
        }

        .nav-menu .active {
            background: #eeeaff;
            color: #624ee5;
        }


        /* =========================
           CONTAINER
        ========================== */

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 60px 25px;
        }


        /* =========================
           PAGE HEADER
        ========================== */

        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .page-header .badge {
            display: inline-block;

            background: #e9e5ff;
            color: #654fe5;

            padding: 8px 18px;
            border-radius: 30px;

            font-size: 14px;
            font-weight: 700;

            margin-bottom: 15px;
        }

        .page-header h1 {
            font-size: 38px;
            color: #282348;
            margin-bottom: 12px;
        }

        .page-header p {
            color: #77728f;
            font-size: 16px;
        }


        /* =========================
           CARD
        ========================== */

        .history-card {
            background: #ffffff;

            border-radius: 22px;

            padding: 35px;

            box-shadow:
                0 15px 45px rgba(77, 61, 160, 0.10);

            border: 1px solid #eeeaff;
        }


        /* =========================
           CARD HEADER
        ========================== */

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-bottom: 25px;
        }

        .card-title {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .icon {
            width: 48px;
            height: 48px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 14px;

            background: linear-gradient(
                135deg,
                #725cf0,
                #5d49d9
            );

            color: white;

            font-size: 22px;
            font-weight: bold;
        }

        .card-title h2 {
            font-size: 22px;
            color: #312b65;
        }

        .total-data {
            background: #f2efff;
            color: #614cdf;

            padding: 9px 15px;

            border-radius: 20px;

            font-size: 14px;
            font-weight: 700;
        }


        /* =========================
           TABLE
        ========================== */

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f5f3ff;
        }

        th {
            padding: 17px 20px;

            text-align: left;

            color: #5d567c;

            font-size: 14px;
            font-weight: 700;

            border-bottom: 1px solid #e8e4f7;
        }

        td {
            padding: 20px;

            border-bottom: 1px solid #eeeef5;

            color: #4a4563;

            font-size: 15px;
        }

        tbody tr {
            transition: 0.2s;
        }

        tbody tr:hover {
            background: #faf9ff;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }


        /* =========================
           NOMOR
        ========================== */

        .number {
            width: 45px;
            height: 45px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            border-radius: 12px;

            background: #eeeaff;
            color: #634ee0;

            font-weight: 700;
        }


        /* =========================
           NAMA
        ========================== */

        .name {
            font-weight: 700;
            color: #302a55;
        }


        /* =========================
           KURSUS
        ========================== */

        .course {
            display: inline-block;

            background: #f1efff;

            color: #604bdc;

            padding: 8px 14px;

            border-radius: 20px;

            font-size: 13px;
            font-weight: 700;
        }


        /* =========================
           HARGA
        ========================== */

        .price {
            font-weight: 800;
            color: #4f3dcc;
            white-space: nowrap;
        }


        /* =========================
           FOOTER
        ========================== */

        footer {
            text-align: center;

            padding: 30px;

            color: #817b9a;

            font-size: 14px;
        }


        /* =========================
           RESPONSIVE
        ========================== */

        @media (max-width: 800px) {

            .navbar {
                padding: 20px;
                flex-direction: column;
                align-items: flex-start;
            }

            .nav-menu {
                width: 100%;
            }

            .nav-menu a {
                padding: 9px 12px;
                font-size: 14px;
            }

            .container {
                padding: 35px 15px;
            }

            .page-header h1 {
                font-size: 30px;
            }

            .history-card {
                padding: 20px;
            }

            .card-header {
                align-items: flex-start;
                gap: 15px;
                flex-direction: column;
            }

            th,
            td {
                padding: 14px;
            }
        }

    </style>

</head>


<body>


<!-- =========================
     HEADER
========================== -->

<header>

    <div class="navbar">

        <a href="index.php" class="brand">
            KursusKu UIN
        </a>

        <nav class="nav-menu">

            <a href="index.php">
                Beranda
            </a>

            <a href="index.php#keunggulan">
                Keunggulan
            </a>

            <a href="index.php#katalog">
                Katalog
            </a>

            <a href="index.php#alur">
                Cara Daftar
            </a>

            <a href="index.php#kontak">
                Kontak
            </a>

            <a href="register.php">
                Daftar P6
            </a>

            <a href="history.php" class="active">
                History
            </a>

        </nav>

    </div>

</header>



<!-- =========================
     MAIN
========================== -->

<main class="container">


    <section class="page-header">

        <span class="badge">
            RIWAYAT PENDAFTARAN
        </span>

        <h1>
            History Kursus
        </h1>

        <p>
            Daftar peserta dan riwayat kursus yang telah terdaftar.
        </p>

    </section>



    <!-- =========================
         HISTORY CARD
    ========================== -->

    <section class="history-card">


        <div class="card-header">

            <div class="card-title">

                <div class="icon">
                    ✓
                </div>

                <div>
                    <h2>
                        Data Pendaftaran
                    </h2>
                </div>

            </div>


            <div class="total-data">
                <?= count($history) ?> Peserta
            </div>

        </div>



        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>
                            No
                        </th>

                        <th>
                            Nama
                        </th>

                        <th>
                            Kursus
                        </th>

                        <th>
                            Total Pembayaran
                        </th>

                    </tr>

                </thead>


                <tbody>

                    <?php foreach ($history as $index => $item): ?>

                        <tr>

                            <td>

                                <span class="number">
                                    <?= $index + 1 ?>
                                </span>

                            </td>


                            <td>

                                <span class="name">
                                    <?= e($item['name']) ?>
                                </span>

                            </td>


                            <td>

                                <span class="course">
                                    <?= e($item['course']) ?>
                                </span>

                            </td>


                            <td>

                                <span class="price">
                                    <?= Rupiah($item['total']) ?>
                                </span>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>


    </section>


</main>



<!-- =========================
     FOOTER
========================== -->

<footer>

    &copy; <?= date('Y') ?> KursusKu UIN
    &mdash;
    Sistem Pendaftaran Kursus

</footer>


</body>
</html>