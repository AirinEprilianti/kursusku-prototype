<?php

session_start();

require __DIR__ . '/data.php';
require __DIR__ . '/helpers.php';


/* =====================================================
   CEK REQUEST
===================================================== */

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.php');
    exit;
}


/* =====================================================
   AMBIL DATA FORM
===================================================== */

$name = trim($_POST['name'] ?? '');

$email = trim($_POST['email'] ?? '');

$courseCode = $_POST['course_code'] ?? '';

$participantType = $_POST['participant_type'] ?? '';

$learningMode = $_POST['learning_mode'] ?? '';

$packageCount = (int) ($_POST['package_count'] ?? 1);

$notes = trim($_POST['notes'] ?? '');

$interests = $_POST['interests'] ?? [];


if (!is_array($interests)) {
    $interests = [];
}


/* =====================================================
   VALIDASI MINAT
===================================================== */

$allowedInterestKeys = array_keys($interestOptions);

$interests = array_values(
    array_intersect(
        $interests,
        $allowedInterestKeys
    )
);


/* =====================================================
   VALIDASI
===================================================== */

$errors = [];


if ($name === '') {
    $errors[] = 'Nama wajib diisi.';
}


if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Format email tidak valid.';
}


$course = findCourse(
    $courses,
    $courseCode
);


if ($course === null) {
    $errors[] = 'Kursus tidak ditemukan.';
}


if (!in_array(
    $participantType,
    ['mahasiswa', 'guru', 'umum'],
    true
)) {
    $errors[] = 'Tipe peserta tidak valid.';
}


if (!in_array(
    $learningMode,
    ['offline', 'online', 'hybrid'],
    true
)) {
    $errors[] = 'Metode belajar tidak valid.';
}


if (!in_array(
    $packageCount,
    [1, 2, 3],
    true
)) {
    $errors[] = 'Jumlah paket tidak valid.';
}


/* =====================================================
   JIKA ERROR
===================================================== */

if ($errors !== []) {
?>

<!doctype html>

<html lang="id">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>
        Data Belum Valid - KursusKu UIN
    </title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f3ff;
            color: #29233d;
        }

        .error-container {
            width: min(700px, calc(100% - 30px));
            margin: 80px auto;
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(75, 55, 150, .10);
        }

        .error-icon {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            background: #fff0f0;
            color: #d94141;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        h1 {
            margin-top: 0;
        }

        .error-list {
            background: #fff5f5;
            border: 1px solid #ffdada;
            border-radius: 12px;
            padding: 20px 20px 20px 40px;
            color: #b63131;
        }

        .back-button {
            display: inline-block;
            margin-top: 15px;
            padding: 13px 20px;
            border-radius: 10px;
            background: #6c5ce7;
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

    </style>

</head>

<body>

<div class="error-container">

    <div class="error-icon">
        !
    </div>

    <p style="color:#6c5ce7;font-weight:bold;">
        PENDAFTARAN
    </p>

    <h1>
        Data Belum Valid
    </h1>

    <p>
        Silakan periksa kembali data yang Anda masukkan.
    </p>

    <ul class="error-list">

        <?php foreach ($errors as $error): ?>

            <li>
                <?= e($error) ?>
            </li>

        <?php endforeach; ?>

    </ul>

    <a
        href="register.php"
        class="back-button"
    >
        Kembali ke Form
    </a>

</div>

</body>

</html>

<?php

exit;

}


/* =====================================================
   HITUNG BIAYA
===================================================== */

$discountPercent =
    getDiscountPercent($participantType);


$grossTotal =
    $course['fee'] * $packageCount;


$discountAmount =
    intdiv(
        $grossTotal * $discountPercent,
        100
    );


$finalTotal =
    $grossTotal - $discountAmount;

// =====================================
// TOKEN SUDAH BERHASIL DIPAKAI
// =====================================

unset($_SESSION['form_token']);


// =====================================
// HITUNG LABEL METODE BELAJAR
// =====================================

$learningModeLabel =
    getLearningModeLabel($learningMode);


// =====================================
// SIMPAN DATA KE HISTORY - SATU KALI
// =====================================

if (!isset($_SESSION['history'])) {
    $_SESSION['history'] = [];
}

$_SESSION['history'][] = [
    'name'   => $name,
    'email'  => $email,
    'course' => $course['name'],
    'total'  => $finalTotal
];

?>
<!doctype html>

<html lang="id">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>
        Ringkasan Pendaftaran - KursusKu UIN
    </title>


    <style>

        /* =================================================
           GLOBAL
        ================================================= */

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            color: #292342;

            background:
                linear-gradient(
                    135deg,
                    #f5f3ff 0%,
                    #faf9ff 50%,
                    #eeeaff 100%
                );
        }


        a {
            text-decoration: none;
        }


        .container {
            width: min(
                1200px,
                calc(100% - 40px)
            );

            margin: auto;
        }


        /* =================================================
           HEADER
        ================================================= */

        .site-header {
            background: rgba(
                255,
                255,
                255,
                .95
            );

            border-bottom:
                1px solid #eeeaf7;

            position: sticky;

            top: 0;

            z-index: 100;

            backdrop-filter: blur(10px);
        }


        .nav-wrap {

            min-height: 74px;

            display: flex;

            align-items: center;

            gap: 30px;
        }


        .brand {

            margin-right: auto;

            font-size: 24px;

            font-weight: 800;

            color: #6655df;
        }


        .main-nav {

            display: flex;

            align-items: center;

            gap: 27px;
        }


        .main-nav a {

            color: #514a68;

            font-size: 14px;

            font-weight: 600;

            padding: 9px 12px;

            border-radius: 9px;

            transition: .2s;
        }


        .main-nav a:hover {

            color: #634fe0;

            background: #f2efff;
        }


        .main-nav .active {

            color: #634fe0;

            background: #f0edff;
        }


        /* =================================================
           HERO
        ================================================= */

        .result-hero {

            position: relative;

            overflow: hidden;

            padding:
                55px 0
                40px;
        }


        .result-hero::before {

            content: "";

            position: absolute;

            width: 260px;

            height: 260px;

            border-radius: 50%;

            background:
                rgba(124, 103, 239, .08);

            left: -120px;

            top: -100px;
        }


        .result-hero::after {

            content: "";

            position: absolute;

            width: 230px;

            height: 230px;

            border-radius: 50%;

            background:
                rgba(124, 103, 239, .08);

            right: -100px;

            top: -80px;
        }


        .hero-content {

            position: relative;

            z-index: 2;
        }


        .hero-label {

            display: inline-flex;

            align-items: center;

            gap: 8px;

            padding:
                8px 14px;

            border-radius: 20px;

            background: #ebe8ff;

            color: #6655df;

            font-size: 13px;

            font-weight: 700;
        }


        .result-hero h1 {

            margin:
                16px 0 10px;

            font-size: 42px;

            line-height: 1.15;

            color: #302861;
        }


        .result-hero p {

            margin: 0;

            color: #716b8d;

            font-size: 17px;
        }


        /* =================================================
           SUCCESS ICON
        ================================================= */

        .success-icon {

            position: absolute;

            right: 100px;

            top: 35px;

            width: 100px;

            height: 100px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 25px;

            background:
                linear-gradient(
                    135deg,
                    #896ff5,
                    #6045df
                );

            color: white;

            font-size: 45px;

            font-weight: bold;

            transform: rotate(5deg);

            box-shadow:
                0 15px 35px
                rgba(100, 76, 220, .25);
        }


        /* =================================================
           CONTENT GRID
        ================================================= */

        .result-grid {

            display: grid;

            grid-template-columns:
                minmax(0, 1.8fr)
                minmax(300px, .8fr);

            gap: 25px;

            padding-bottom: 55px;
        }


        /* =================================================
           CARD
        ================================================= */

        .card {

            background: #fff;

            border:
                1px solid #eeeaf7;

            border-radius: 20px;

            box-shadow:
                0 15px 40px
                rgba(71, 55, 135, .08);
        }


        .main-card {

            padding: 25px;
        }


        /* =================================================
           CARD TITLE
        ================================================= */

        .card-heading {

            display: flex;

            align-items: center;

            gap: 14px;

            padding: 20px;

            border-radius: 16px;

            background:
                linear-gradient(
                    135deg,
                    #f3f0ff,
                    #faf9ff
                );

            margin-bottom: 10px;
        }


        .heading-icon {

            width: 48px;

            height: 48px;

            flex-shrink: 0;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 50%;

            background:
                linear-gradient(
                    135deg,
                    #7967ed,
                    #5d47da
                );

            color: white;

            font-size: 20px;
        }


        .card-heading h2 {

            margin: 0 0 4px;

            color: #4938b6;

            font-size: 20px;
        }


        .card-heading p {

            margin: 0;

            color: #7c7592;

            font-size: 13px;
        }


        /* =================================================
           DETAILS
        ================================================= */

        .detail-grid {

            display: grid;

            grid-template-columns:
                repeat(2, 1fr);
        }


        .detail-item {

            padding: 22px 18px;

            border-bottom:
                1px solid #eeeaf5;
        }


        .detail-item:nth-child(odd) {

            border-right:
                1px solid #eeeaf5;
        }


        .detail-label {

            display: block;

            margin-bottom: 7px;

            color: #77718b;

            font-size: 13px;

            font-weight: 600;
        }


        .detail-value {

            color: #302943;

            font-size: 16px;

            font-weight: 700;
        }


        /* =================================================
           PRICE
        ================================================= */

        .price-card {

            margin-top: 18px;

            padding: 22px;

            border-radius: 16px;

            background:
                linear-gradient(
                    135deg,
                    #f1efff,
                    #faf9ff
                );
        }


        .price-title {

            display: flex;

            align-items: center;

            gap: 10px;

            margin-bottom: 18px;
        }


        .price-title-icon {

            width: 34px;

            height: 34px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 50%;

            background: #705ce7;

            color: white;

            font-weight: bold;
        }


        .price-title strong {

            color: #403492;

            font-size: 17px;
        }


        .price-content {

            display: grid;

            grid-template-columns:
                repeat(3, 1fr);
        }


        .price-item {

            padding: 5px 20px;

            border-right:
                1px solid #ddd8f1;
        }


        .price-item:last-child {

            border-right: none;
        }


        .price-item span {

            display: block;

            margin-bottom: 7px;

            color: #77718e;

            font-size: 13px;
        }


        .price-item strong {

            color: #5541d5;

            font-size: 19px;
        }


        .price-item.discount strong {

            color: #dc5370;
        }


        .price-item.final strong {

            font-size: 24px;
        }


        /* =================================================
           RIGHT COLUMN
        ================================================= */

        .side-card {

            overflow: hidden;
        }


        .interest-card {

            padding: 28px;

            background:
                linear-gradient(
                    135deg,
                    #7356e8,
                    #6942dc,
                    #8a55ef
                );

            color: white;
        }


        .side-title {

            display: flex;

            align-items: center;

            gap: 10px;

            margin-bottom: 18px;
        }


        .side-title h2 {

            margin: 0;

            font-size: 18px;
        }


        .count-badge {

            display: inline-block;

            margin-bottom: 18px;

            padding: 7px 12px;

            border-radius: 20px;

            background:
                rgba(255,255,255,.18);

            font-size: 13px;
        }


        .interest-list {

            display: flex;

            flex-wrap: wrap;

            gap: 9px;
        }


        .interest-badge {

            display: inline-block;

            padding: 9px 13px;

            border-radius: 20px;

            background: white;

            color: #654bd5;

            font-size: 13px;

            font-weight: 700;
        }


        /* =================================================
           NOTE
        ================================================= */

        .note-card {

            padding: 28px;
        }


        .note-title {

            display: flex;

            align-items: center;

            gap: 10px;

            margin-bottom: 15px;
        }


        .note-title h2 {

            margin: 0;

            font-size: 18px;
        }


        .note-box {

            min-height: 80px;

            padding: 18px;

            border-radius: 13px;

            background: #f7f5ff;

            color: #68627b;

            line-height: 1.6;
        }


        /* =================================================
           THANK YOU
        ================================================= */

        .thank-you {

            margin-top: 35px;

            padding: 25px;

            border-radius: 15px;

            background:
                linear-gradient(
                    135deg,
                    #f0edff,
                    #f8f7ff
                );
        }


        .thank-you h3 {

            margin:
                0 0 8px;

            color: #4536a8;
        }


        .thank-you p {

            margin: 0;

            color: #746e8c;

            font-size: 14px;

            line-height: 1.7;
        }


        /* =================================================
           ACTION
        ================================================= */

        .actions {

            display: flex;

            gap: 12px;

            margin-top: 25px;
        }


        .btn {

            display: inline-flex;

            justify-content: center;

            align-items: center;

            padding:
                13px 20px;

            border-radius: 11px;

            font-weight: 700;

            font-size: 14px;
        }


        .btn-primary {

            background:
                linear-gradient(
                    135deg,
                    #7663ec,
                    #5d48d8
                );

            color: white;

            box-shadow:
                0 8px 20px
                rgba(101, 78, 218, .20);
        }


        .btn-secondary {

            background: #eeebff;

            color: #604dd7;
        }


        /* =================================================
           FOOTER
        ================================================= */

        footer {

            padding: 28px;

            text-align: center;

            color: #817a95;

            font-size: 13px;

            border-top:
                1px solid #eeeaf7;
        }


        /* =================================================
           RESPONSIVE
        ================================================= */

        @media (max-width: 900px) {

            .main-nav {

                display: none;
            }


            .success-icon {

                display: none;
            }


            .result-hero h1 {

                font-size: 32px;
            }


            .result-grid {

                grid-template-columns: 1fr;
            }

        }


        @media (max-width: 600px) {

            .container {

                width:
                    min(
                        100% - 25px,
                        1200px
                    );
            }


            .detail-grid {

                grid-template-columns: 1fr;
            }


            .detail-item:nth-child(odd) {

                border-right: none;
            }


            .price-content {

                grid-template-columns: 1fr;
            }


            .price-item {

                padding: 15px 0;

                border-right: none;

                border-bottom:
                    1px solid #ddd8f1;
            }


            .price-item:last-child {

                border-bottom: none;
            }


            .actions {

                flex-direction: column;
            }


            .btn {

                width: 100%;
            }

        }

    </style>

</head>


<body>


<!-- =====================================================
     HEADER
===================================================== -->

<header class="site-header">

    <div class="container nav-wrap">

        <a
            href="index.php"
            class="brand"
        >
            KursusKu UIN
        </a>


        <nav class="main-nav">

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
                Daftar Kursus
            </a>

            <a
                href="history.php"
                class="active"
            >
                History Dummy
            </a>

        </nav>

    </div>

</header>



<!-- =====================================================
     HERO
===================================================== -->

<section class="result-hero">

    <div class="container hero-content">

        <span class="hero-label">

            ✓

            Riwayat Pendaftaran

        </span>


        <h1>
            Pendaftaran Berhasil Diproses
        </h1>


        <p>
            Berikut adalah rincian data pendaftaran kursus Anda.
        </p>


        <div class="success-icon">
            ✓
        </div>

    </div>

</section>



<!-- =====================================================
     CONTENT
===================================================== -->

<main class="container result-grid">


    <!-- =================================================
         LEFT
    ================================================= -->

    <section class="card main-card">


        <!-- DATA PENDAFTARAN -->

        <div class="card-heading">

            <div class="heading-icon">
                👤
            </div>

            <div>

                <h2>
                    Data Pendaftaran
                </h2>

                <p>
                    Informasi peserta dan kursus yang dipilih.
                </p>

            </div>

        </div>


        <div class="detail-grid">


            <div class="detail-item">

                <span class="detail-label">
                    Nama Lengkap
                </span>

                <span class="detail-value">
                    <?= e($name) ?>
                </span>

            </div>


            <div class="detail-item">

                <span class="detail-label">
                    Email
                </span>

                <span class="detail-value">
                    <?= e($email) ?>
                </span>

            </div>


            <div class="detail-item">

                <span class="detail-label">
                    Kursus
                </span>

                <span class="detail-value">
                    <?= e($course['name']) ?>
                </span>

            </div>


            <div class="detail-item">

                <span class="detail-label">
                    Tipe Peserta
                </span>

                <span class="detail-value">
                    <?= e(ucfirst($participantType)) ?>
                </span>

            </div>


            <div class="detail-item">

                <span class="detail-label">
                    Metode Belajar
                </span>

                <span class="detail-value">
                    <?= e($learningModeLabel) ?>
                </span>

            </div>


            <div class="detail-item">

                <span class="detail-label">
                    Jumlah Paket
                </span>

                <span class="detail-value">
                    <?= $packageCount ?> Paket
                </span>

            </div>


        </div>



        <!-- RINCIAN BIAYA -->

        <div class="price-card">


            <div class="price-title">

                <div class="price-title-icon">
                    Rp
                </div>

                <strong>
                    Rincian Biaya
                </strong>

            </div>


            <div class="price-content">


                <div class="price-item">

                    <span>
                        Subtotal
                    </span>

                    <strong>
                        <?= Rupiah($grossTotal) ?>
                    </strong>

                </div>


                <div class="price-item discount">

                    <span>
                        Diskon
                        (<?= $discountPercent ?>%)
                    </span>

                    <strong>
                        - <?= Rupiah($discountAmount) ?>
                    </strong>

                </div>


                <div class="price-item final">

                    <span>
                        Total Akhir
                    </span>

                    <strong>
                        <?= Rupiah($finalTotal) ?>
                    </strong>

                </div>


            </div>

        </div>


    </section>



    <!-- =================================================
         RIGHT
    ================================================= -->

    <aside class="card side-card">


        <!-- MINAT -->

        <div class="interest-card">


            <div class="side-title">

                <span>
                    ♡
                </span>

                <h2>
                    Minat Tambahan
                </h2>

            </div>


            <span class="count-badge">

                <?= count($interests) ?>

                item dipilih

            </span>


            <div class="interest-list">


                <?php if ($interests === []): ?>

                    <span class="interest-badge">
                        Belum memilih
                    </span>

                <?php else: ?>

                    <?php foreach ($interests as $interest): ?>

                        <?php
                        $label =
                            $interestOptions[$interest]
                            ?? $interest;
                        ?>

                        <span class="interest-badge">

                            <?= e($label) ?>

                        </span>

                    <?php endforeach; ?>

                <?php endif; ?>


            </div>

        </div>



        <!-- CATATAN -->

        <div class="note-card">


            <div class="note-title">

                <span>
                    📝
                </span>

                <h2>
                    Catatan
                </h2>

            </div>


            <div class="note-box">

                <?php if ($notes !== ''): ?>

                    <?= nl2br(e($notes)) ?>

                <?php else: ?>

                    Tidak ada catatan tambahan.

                <?php endif; ?>

            </div>



            <!-- TERIMA KASIH -->

            <div class="thank-you">

                <h3>
                    💡 Terima Kasih!
                </h3>

                <p>

                    Data pendaftaran Anda telah berhasil
                    diproses. Silakan cek halaman history
                    untuk melihat daftar lengkap pendaftaran
                    Anda.

                </p>

            </div>



            <!-- BUTTON -->

            <div class="actions">

                <a
                    href="register.php"
                    class="btn btn-secondary"
                >
                    Daftar Lagi
                </a>


                <a
                    href="history.php"
                    class="btn btn-primary"
                >
                    Lihat History
                </a>

            </div>


        </div>


    </aside>


</main>



<!-- =====================================================
     FOOTER
===================================================== -->

<footer>

    © <?= date('Y') ?>

    KursusKu UIN.

    Semua hak dilindungi.

</footer>


</body>

</html>