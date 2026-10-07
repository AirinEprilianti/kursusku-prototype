<?php
require __DIR__ . '/data.php';
require __DIR__ . '/helpers.php';

if (empty($_SESSION['form_token'])) {
    $_SESSION['form_token'] = bin2hex(random_bytes(32));
}
?>

<!doctype html>
<html lang="id">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>Daftar Kursus - KursusKu UIN</title>

    <link
        rel="stylesheet"
        href="assets/css/style.css"
    >

    <style>

        /* ================================
           GLOBAL
        ================================= */

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f6f4ff;
            color: #27213b;
        }


        /* ================================
           HEADER
        ================================= */

        header {
            background: #ffffff;
            border-bottom: 1px solid #eeeaf8;
            padding: 18px 50px;
        }

        header nav {
            max-width: 1200px;
            margin: auto;

            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 25px;
        }

        .brand {
            color: #6957e8;
            font-size: 24px;
            font-weight: 800;
            text-decoration: none;
            margin-right: auto;
        }

        header nav a {
            color: #514b67;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
        }

        header nav a:hover {
            color: #6957e8;
        }


        /* ================================
           MAIN
        ================================= */

        .register-container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 0 25px;
        }


        /* ================================
           TITLE
        ================================= */

        .register-header {
            margin-bottom: 35px;
        }

        .register-header .label {
            display: inline-block;

            padding: 7px 13px;

            border-radius: 20px;

            background: #ebe8ff;
            color: #6655df;

            font-size: 13px;
            font-weight: 700;

            margin-bottom: 12px;
        }

        .register-header h1 {
            margin: 0 0 10px;

            font-size: 38px;
            color: #241e36;
        }

        .register-header p {
            margin: 0;

            color: #7d778c;
            font-size: 16px;
        }


        /* ================================
           LAYOUT
        ================================= */

        .register-layout {
            display: grid;

            grid-template-columns:
                minmax(0, 1.7fr)
                minmax(300px, 0.8fr);

            gap: 25px;

            align-items: start;
        }


        /* ================================
           FORM CARD
        ================================= */

        .register-form {
            background: #ffffff;

            padding: 35px;

            border-radius: 20px;

            border: 1px solid #ece9f6;

            box-shadow:
                0 15px 40px
                rgba(76, 61, 145, 0.08);
        }


        .form-title {
            margin-bottom: 28px;

            padding-bottom: 20px;

            border-bottom: 1px solid #eeeaf5;
        }

        .form-title h2 {
            margin: 0 0 7px;

            font-size: 23px;
        }

        .form-title p {
            margin: 0;

            color: #898398;

            font-size: 14px;
        }


        /* ================================
           FORM
        ================================= */

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label,
        fieldset legend {
            display: block;

            font-weight: 700;

            font-size: 14px;

            color: #332c46;
        }

        .form-group label {
            margin-bottom: 9px;
        }


        input[type="text"],
        input[type="email"],
        select,
        textarea {

            width: 100%;

            padding: 14px 15px;

            border: 1px solid #dedbe7;

            border-radius: 11px;

            background: #ffffff;

            color: #302a40;

            font-size: 15px;

            transition: 0.2s;
        }


        input[type="text"]:focus,
        input[type="email"]:focus,
        select:focus,
        textarea:focus {

            outline: none;

            border-color: #7564eb;

            box-shadow:
                0 0 0 4px
                rgba(117, 100, 235, 0.10);
        }


        textarea {
            resize: vertical;
            min-height: 110px;
        }


        /* ================================
           COURSE SELECT
        ================================= */

        .course-box {

            background: #f8f7ff;

            border: 1px solid #e5e1fb;

            border-radius: 14px;

            padding: 15px;
        }

        .course-box select {
            background: #ffffff;
        }


        /* ================================
           FIELDSET
        ================================= */

        fieldset {

            border: 1px solid #e4e1ed;

            border-radius: 14px;

            padding: 20px;

            margin: 0 0 22px;
        }

        fieldset legend {

            padding: 0 8px;

            color: #6655df;
        }

        fieldset label {

            display: flex;

            align-items: center;

            gap: 10px;

            margin-top: 13px;

            color: #504a5d;

            font-weight: 500;
        }

        input[type="radio"],
        input[type="checkbox"] {
            width: 17px;
            height: 17px;

            accent-color: #6c5ce7;
        }


        /* ================================
           SUBMIT
        ================================= */

        .submit-button {

            width: 100%;

            padding: 15px;

            border: none;

            border-radius: 12px;

            background:
                linear-gradient(
                    135deg,
                    #7968ee,
                    #5b49d8
                );

            color: white;

            font-size: 16px;

            font-weight: 700;

            cursor: pointer;

            box-shadow:
                0 10px 22px
                rgba(105, 87, 232, 0.25);

            transition: 0.2s;
        }

        .submit-button:hover {

            transform: translateY(-2px);

            box-shadow:
                0 14px 28px
                rgba(105, 87, 232, 0.30);
        }


        /* ================================
           RIGHT SIDEBAR
        ================================= */

        .register-info {

            position: sticky;

            top: 25px;

            border-radius: 20px;

            overflow: hidden;

            background: #ffffff;

            box-shadow:
                0 15px 40px
                rgba(76, 61, 145, 0.10);

            border: 1px solid #ece9f6;
        }


        .info-header {

            padding: 28px;

            background:
                linear-gradient(
                    135deg,
                    #7968ee,
                    #5542d1
                );

            color: white;
        }

        .info-header span {

            font-size: 13px;

            opacity: 0.8;
        }

        .info-header h2 {

            margin: 7px 0 0;

            font-size: 24px;
        }
        .info-header h2 {
    margin: 8px 0 0;
    font-size: 28px;
    color: #ffffff !important;
    opacity: 1 !important;
    font-weight: 800;
    line-height: 1.2;
    letter-spacing: -0.5px;
    font-family: Arial, Helvetica, sans-serif;
}


        .info-body {
            padding: 28px;
        }

        .info-body h3 {

            margin: 0 0 18px;

            font-size: 17px;
        }


        /* ================================
           FACILITIES
        ================================= */

        .facility {

            display: flex;

            align-items: flex-start;

            gap: 12px;

            margin-bottom: 17px;
        }

        .facility-icon {

            width: 32px;
            height: 32px;

            flex-shrink: 0;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 9px;

            background: #eeeaff;

            color: #6857df;

            font-weight: 700;
        }

        .facility p {

            margin: 0;

            color: #666075;

            font-size: 14px;

            line-height: 1.5;
        }


        /* ================================
           INFO BOTTOM
        ================================= */

        .info-note {

            margin-top: 25px;

            padding: 15px;

            background: #f8f7ff;

            border-radius: 12px;

            color: #6c6678;

            font-size: 13px;

            line-height: 1.6;
        }


        /* ================================
           FOOTER
        ================================= */

        footer {
    text-align: center;
    padding: 30px;
    color: #ffffff;
    font-size: 14px;
    font-weight: 600;
}


        /* ================================
           RESPONSIVE
        ================================= */

        @media (max-width: 850px) {

            header {
                padding: 18px 20px;
            }

            header nav {
                flex-wrap: wrap;
                justify-content: center;
            }

            .brand {
                width: 100%;
                text-align: center;
            }

            .register-layout {
                grid-template-columns: 1fr;
            }

            .register-info {
                position: static;
            }

            .register-header h1 {
                font-size: 30px;
            }

        }

    </style>

</head>


<body>


<!-- =================================
     HEADER
================================= -->

<header>

    <nav aria-label="Navigasi utama">

        <a
            href="index.php"
            class="brand"
        >
            KursusKu UIN
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

        <a href="registration.php">
            Form P5
        </a>

        <a href="history.php">
            History
        </a>

    </nav>

</header>



<!-- =================================
     MAIN
================================= -->

<main class="register-container">


    <!-- JUDUL -->

    <section class="register-header">

        <span class="label">
            Pendaftaran Kursus
        </span>

        <h1>
            Form Pendaftaran Kursus
        </h1>

        <p>
            Lengkapi data di bawah ini untuk mengikuti
            kursus pilihan Anda.
        </p>

    </section>



    <!-- LAYOUT -->

    <div class="register-layout">


        <!-- =================================
             FORM
        ================================= -->

        <form
            method="POST"
            action="proses.php"
            class="register-form"
        >
<input type="hidden"
           name="form_token"
           value="<?= e($_SESSION['form_token']) ?>">

            <div class="form-title">

                <h2>
                    Data Pendaftaran
                </h2>

                <p>
                    Silakan isi semua informasi yang diperlukan.
                </p>

            </div>



            <!-- NAMA -->

            <div class="form-group">

                <label for="name">
                    Nama Lengkap
                </label>

                <input
                    id="name"
                    name="name"
                    type="text"
                    placeholder="Masukkan nama lengkap"
                    required
                >

            </div>



            <!-- EMAIL -->

            <div class="form-group">

                <label for="email">
                    Email
                </label>

                <input
                    id="email"
                    name="email"
                    type="email"
                    placeholder="contoh@email.com"
                    required
                >

            </div>



            <!-- KURSUS -->

            <div class="form-group">

                <label for="course_code">
                    Pilih Kursus
                </label>

                <div class="course-box">

                    <select
                        id="course_code"
                        name="course_code"
                        required
                    >

                        <option value="">
                            -- Pilih kursus --
                        </option>


                        <?php foreach ($courses as $course): ?>

                            <option
                                value="<?= e($course['code']) ?>"
                            >

                                <?= e($course['name']) ?>
                                -
                                <?= rupiah($course['fee']) ?>

                            </option>

                        <?php endforeach; ?>


                    </select>

                </div>

            </div>



            <!-- TIPE PESERTA -->

            <fieldset>

                <legend>
                    Tipe Peserta
                </legend>


                <label>

                    <input
                        type="radio"
                        name="participant_type"
                        value="mahasiswa"
                        required
                    >

                    Mahasiswa

                </label>
<label>

                    <input
                        type="radio"
                        name="participant_type"
                        value="guru"
                        required
                    >

                    Guru

                </label>


                <label>

                    <input
                        type="radio"
                        name="participant_type"
                        value="umum"
                    >

                    Umum

                </label>

            </fieldset>



            <!-- MINAT -->

            <fieldset>

                <legend>
                    Minat Belajar
                </legend>


                <?php foreach (
                    $interestOptions
                    as $value => $label
                ): ?>

                    <label>

                        <input
                            type="checkbox"
                            name="interests[]"
                            value="<?= e($value) ?>"
                        >

                        <?= e($label) ?>

                    </label>

                <?php endforeach; ?>


            </fieldset>



            <!-- METODE -->

            <div class="form-group">

                <label for="learning_mode">
                    Metode Belajar
                </label>

                <select
                    id="learning_mode"
                    name="learning_mode"
                    required
                >

                    <option value="">
                        -- Pilih metode --
                    </option>

                    <option value="offline">
                        Tatap Muka
                    </option>

                    <option value="online">
                        Online
                    </option>

                    <option value="hybrid">
                        Hybrid
                    </option>

                </select>

            </div>



            <!-- PAKET -->

            <div class="form-group">

                <label for="package_count">
                    Jumlah Paket
                </label>

                <select
                    id="package_count"
                    name="package_count"
                    required
                >

                    <?php for (
                        $i = 1;
                        $i <= 3;
                        $i++
                    ): ?>

                        <option value="<?= $i ?>">

                            <?= $i ?> Paket

                        </option>

                    <?php endfor; ?>

                </select>

            </div>



            <!-- CATATAN -->

            <div class="form-group">

                <label for="notes">
                    Catatan Tambahan
                </label>

                <textarea
                    id="notes"
                    name="notes"
                    rows="4"
                    maxlength="300"
                    placeholder="Tulis kebutuhan belajar Anda..."
                ></textarea>

            </div>



            <!-- SUBMIT -->

            <button
                type="submit"
                class="submit-button"
            >

                Daftar Sekarang

            </button>


        </form>



        <!-- =================================
             INFORMASI KURSUS
        ================================= -->

        <aside class="register-info">


            <div class="info-header">

                <span>
                    KURSUSKU UIN
                </span>

                <h2>
                    Apa yang Anda dapatkan?
                </h2>

            </div>


            <div class="info-body">

                <h3>
                    Fasilitas Kursus
                </h3>


                <?php foreach (
                    $facilities
                    as $index => $facility
                ): ?>

                    <div class="facility">

                        <div class="facility-icon">

                            <?= $index + 1 ?>

                        </div>


                        <p>

                            <?= e($facility) ?>

                        </p>

                    </div>

                <?php endforeach; ?>



                <div class="info-note">

                    <strong>
                        💡 Tips
                    </strong>

                    <br>

                    Pastikan data yang Anda masukkan
                    sudah benar sebelum menekan tombol
                    <strong>Daftar Sekarang</strong>.

                </div>

            </div>

        </aside>


    </div>


</main>



<!-- =================================
     FOOTER
================================= -->

<footer>

    <small>

        &copy;
        <?= date('Y') ?>
        KursusKu UIN

    </small>

</footer>


</body>

</html>