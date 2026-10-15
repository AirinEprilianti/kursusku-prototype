<?php
$quota = 30;
$registered = 18;

$isFull = $registered >= $quota;
$hasSeat = $registered < $quota;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logic Test PHP | KursusKu</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 24px;
            font-family: "Segoe UI", Arial, sans-serif;
            background: linear-gradient(135deg, #eee5ff, #f9f6ff, #e9dcff);
            color: #30205f;
        }

        .card {
            width: 100%;
            max-width: 700px;
            padding: 36px;
            background: rgba(255, 255, 255, 0.96);
            border: 1px solid #eee5ff;
            border-radius: 26px;
            box-shadow: 0 20px 55px rgba(109, 40, 217, 0.15);
        }

        .header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 32px;
        }

        .icon {
            width: 72px;
            height: 72px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 22px;
            color: white;
            font-size: 30px;
            font-weight: bold;
            background: linear-gradient(135deg, #8b5cf6, #5b21b6);
        }

        h1 {
            font-size: 30px;
            color: #392078;
            margin-bottom: 7px;
        }

        .subtitle {
            color: #8173a9;
            font-size: 15px;
        }

        .result {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 22px;
            margin-bottom: 16px;
            background: #f7f3ff;
            border: 1px solid #eee6ff;
            border-radius: 17px;
        }

        .result h2 {
            font-size: 19px;
            margin-bottom: 7px;
            color: #432584;
        }

        .result p {
            font-size: 14px;
            color: #776993;
        }

        .badge {
            min-width: 110px;
            padding: 11px 20px;
            text-align: center;
            border-radius: 30px;
            font-size: 15px;
            font-weight: 700;
        }

        .false {
            color: #6d28d9;
            background: #e9ddff;
        }

        .true {
            color: #ffffff;
            background: linear-gradient(135deg, #8b5cf6, #6d28d9);
        }

        .footer {
            margin-top: 30px;
            text-align: center;
        }

        .button {
            display: inline-block;
            padding: 14px 28px;
            border-radius: 30px;
            background: linear-gradient(135deg, #8b5cf6, #5b21b6);
            color: #ffffff;
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(109, 40, 217, 0.25);
        }

        .note {
            margin-top: 18px;
            color: #a195ba;
            font-size: 12px;
        }

        @media (max-width: 500px) {
            .card {
                padding: 24px 18px;
            }

            .header {
                gap: 13px;
            }

            .icon {
                width: 54px;
                height: 54px;
                font-size: 23px;
                border-radius: 16px;
            }

            h1 {
                font-size: 23px;
            }

            .subtitle {
                font-size: 13px;
            }

            .result {
                padding: 17px 14px;
            }

            .badge {
                min-width: 78px;
                padding: 9px 12px;
            }
        }
    </style>
</head>

<body>
    <main class="card">
        <header class="header">
            <div class="icon">&lt;/&gt;</div>
            <div>
                <h1>Logic Test PHP</h1>
                <p class="subtitle">KursusKu · Hasil pengujian logika</p>
            </div>
        </header>

        <section class="result">
            <div>
                <h2>$isFull</h2>
                <p>Apakah kuota sudah penuh?</p>
            </div>
            <span class="badge <?= $isFull ? 'true' : 'false' ?>">
                <?= $isFull ? 'true' : 'false' ?>
            </span>
        </section>

        <section class="result">
            <div>
                <h2>$hasSeat</h2>
                <p>Apakah kursi masih tersedia?</p>
            </div>
            <span class="badge <?= $hasSeat ? 'true' : 'false' ?>">
                <?= $hasSeat ? 'true' : 'false' ?>
            </span>
        </section>

        <footer class="footer">
            <a href="index.php" class="button">
                &larr; Kembali ke KursusKu
            </a>
            <p class="note">KursusKu · PHP Logic Test</p>
        </footer>
    </main>
</body>
</html>