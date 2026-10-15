<?php
$READ = 1;
$WRITE = 2;
$DELETE = 4;

$permission = $READ | $WRITE;

$canRead = ($permission & $READ) === $READ;
$canWrite = ($permission & $WRITE) === $WRITE;
$canDelete = ($permission & $DELETE) === $DELETE;
?>

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bitwise Permission Test</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            padding: 50px 20px;
            font-family: "Segoe UI", Arial, sans-serif;
            color: #35205f;
            background: linear-gradient(135deg, #f7f0ff, #e9dcff);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .utility-card {
            width: 100%;
            max-width: 760px;
            padding: 38px;
            background: #ffffff;
            border: 1px solid #f0e7ff;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(109, 40, 217, 0.13);
        }

        .heading {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-bottom: 12px;
        }

        .heading-icon {
            width: 62px;
            height: 62px;
            flex-shrink: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 18px;
            background: #f0e7ff;
            color: #7c3aed;
            font-size: 30px;
            font-weight: bold;
        }

        h1 {
            margin: 0;
            color: #6b21a8;
            font-size: 30px;
            line-height: 1.3;
        }

        .subtitle {
            margin: 8px 0 28px;
            color: #78678f;
            font-size: 15px;
            line-height: 1.6;
        }

        .permission-list {
            display: grid;
            gap: 12px;
            margin-bottom: 28px;
        }

        .permission-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding: 17px 18px;
            background: #faf7ff;
            border: 1px solid #eee5ff;
            border-radius: 14px;
        }

        .permission-name {
            display: flex;
            align-items: center;
            gap: 13px;
            font-weight: 600;
            color: #432078;
        }

        .permission-icon {
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #eee3ff;
            border-radius: 12px;
            color: #7c3aed;
            font-size: 19px;
        }

        .status {
            padding: 9px 13px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
        }

        .allowed {
            color: #15803d;
            background: #dcfce7;
        }

        .denied {
            color: #be123c;
            background: #ffe4e6;
        }

        .output-box {
            padding: 18px;
            background: #f7f2ff;
            border: 1px solid #eadcff;
            border-radius: 15px;
        }

        .output-title {
            margin: 0 0 13px;
            color: #6b21a8;
            font-size: 16px;
            font-weight: 700;
        }

        pre {
            margin: 0;
            padding: 16px;
            overflow-x: auto;
            background: #eee5ff;
            border-radius: 10px;
            color: #432078;
            font-family: Consolas, monospace;
            font-size: 14px;
            line-height: 1.8;
        }

        .back-link {
            display: inline-block;
            margin-top: 25px;
            padding: 14px 21px;
            border-radius: 12px;
            background: linear-gradient(110deg, #a855f7, #6d28d9);
            color: #ffffff;
            text-decoration: none;
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .back-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(109, 40, 217, 0.25);
        }

        @media (max-width: 520px) {
            body {
                padding: 20px 12px;
            }

            .utility-card {
                padding: 23px 17px;
                border-radius: 19px;
            }

            .heading {
                align-items: flex-start;
                gap: 12px;
            }

            .heading-icon {
                width: 48px;
                height: 48px;
                font-size: 23px;
            }

            h1 {
                font-size: 23px;
            }

            .permission-item {
                align-items: flex-start;
                flex-direction: column;
            }

            .status {
                margin-left: 53px;
            }
        }
    </style>
</head>

<body>

    <main class="utility-card">

        <header class="heading">
            <div class="heading-icon">&lt;/&gt;</div>

            <div>
                <h1>Bitwise Permission Test</h1>
            </div>
        </header>

        <p class="subtitle">
            Status izin akses berdasarkan bitwise operator PHP.
        </p>

        <section class="permission-list">

            <div class="permission-item">
                <div class="permission-name">
                    <span class="permission-icon">&#9673;</span>
                    <span>Can Read</span>
                </div>

                <span class="status <?= $canRead ? 'allowed' : 'denied' ?>">
                    <?= $canRead ? '✓ Diizinkan' : '✕ Tidak diizinkan' ?>
                </span>
            </div>

            <div class="permission-item">
                <div class="permission-name">
                    <span class="permission-icon">&#9998;</span>
                    <span>Can Write</span>
                </div>

                <span class="status <?= $canWrite ? 'allowed' : 'denied' ?>">
                    <?= $canWrite ? '✓ Diizinkan' : '✕ Tidak diizinkan' ?>
                </span>
            </div>

            <div class="permission-item">
                <div class="permission-name">
                    <span class="permission-icon">&#128465;</span>
                    <span>Can Delete</span>
                </div>

                <span class="status <?= $canDelete ? 'allowed' : 'denied' ?>">
                    <?= $canDelete ? '✓ Diizinkan' : '✕ Tidak diizinkan' ?>
                </span>
            </div>

        </section>

        <section class="output-box">

            <h2 class="output-title">&lt;/&gt; Hasil Output</h2>

            <pre><?php
var_dump($canRead, $canWrite, $canDelete);
?></pre>

        </section>

        <a href="index.php" class="back-link">
            &larr; Kembali ke Beranda
        </a>

    </main>

</body>
</html>
