<?php
$rawName = ' Laravel Fundamental ';

$cleanName = trim($rawName);
$upperName = strtoupper($cleanName);
$lowerName = strtolower($cleanName);
$length = strlen($cleanName);
$short = substr($cleanName, 0, 7);
?>

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>String Function Test | KursusKu</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: linear-gradient(135deg, #f5efff, #e9dcff);
            color: #35205f;
            margin: 0;
            padding: 50px 20px;
            min-height: 100vh;
        }

        .utility-card {
            max-width: 700px;
            margin: 0 auto;
            padding: 35px;
            background: #ffffff;
            border-radius: 22px;
            box-shadow: 0 15px 40px rgba(91, 33, 182, 0.13);
        }

        h1 {
            margin: 0 0 10px;
            color: #6b21a8;
            font-size: 30px;
        }

        .description {
            color: #7c6b98;
            margin-bottom: 28px;
            line-height: 1.6;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        li {
            background: #faf7ff;
            border: 1px solid #eee5ff;
            border-radius: 12px;
            padding: 17px 20px;
            margin-bottom: 13px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
        }

        li strong {
            color: #6b21a8;
        }

        li span {
            text-align: right;
            overflow-wrap: anywhere;
        }

        .back-link {
            display: inline-block;
            margin-top: 18px;
            padding: 12px 20px;
            color: #ffffff;
            background: linear-gradient(110deg, #a855f7, #6d28d9);
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.2s;
        }

        .back-link:hover {
            background: #581c87;
        }

        @media (max-width: 520px) {
            body {
                padding: 24px 12px;
            }

            .utility-card {
                padding: 23px 17px;
            }

            h1 {
                font-size: 25px;
            }

            li {
                align-items: flex-start;
                flex-direction: column;
                gap: 8px;
            }

            li span {
                text-align: left;
            }
        }
    </style>
</head>

<body>

    <main class="utility-card">

        <h1>String Function Test</h1>

        <p class="description">
            Hasil pengujian fungsi string PHP pada teks
            <strong>Laravel Fundamental</strong>.
        </p>

        <ul>
            <li>
                <strong>trim()</strong>
                <span><?= htmlspecialchars($cleanName) ?></span>
            </li>

            <li>
                <strong>strtoupper()</strong>
                <span><?= htmlspecialchars($upperName) ?></span>
            </li>

            <li>
                <strong>strtolower()</strong>
                <span><?= htmlspecialchars($lowerName) ?></span>
            </li>

            <li>
                <strong>strlen()</strong>
                <span><?= $length ?> karakter</span>
            </li>

            <li>
                <strong>substr()</strong>
                <span><?= htmlspecialchars($short) ?></span>
            </li>
        </ul>

        <a href="index.php" class="back-link">
            &larr; Kembali ke Beranda
        </a>

    </main>

</body>
</html>
```