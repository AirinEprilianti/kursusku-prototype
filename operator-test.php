<?php
$fee = 350000;
$participants = 2;
$subtotal = $fee * $participants;
$comparisonPositive = $fee > 0;
$comparisonStrict = $fee === 350000;
$message = 'Biaya: Rp ' . $fee;
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Operator Test - KursusKu</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #f5f0ff, #e9ddff);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            color: #30204f;
        }

        .utility-card {
            width: 100%;
            max-width: 650px;
            background: #ffffff;
            border-radius: 24px;
            padding: 36px;
            box-shadow: 0 18px 50px rgba(91, 45, 145, 0.16);
            border: 1px solid #eee5ff;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .icon {
            width: 66px;
            height: 66px;
            margin: 0 auto 16px;
            border-radius: 20px;
            background: linear-gradient(135deg, #8b5cf6, #6d28d9);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            box-shadow: 0 8px 20px rgba(109, 40, 217, 0.25);
        }

        .header h1 {
            font-size: 28px;
            color: #5b21b6;
            margin-bottom: 8px;
        }

        .header p {
            color: #8879a5;
            font-size: 14px;
        }

        .result-list {
            list-style: none;
            display: grid;
            gap: 14px;
        }

        .result-list li {
            padding: 18px 20px;
            background: #faf7ff;
            border: 1px solid #eee5ff;
            border-radius: 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .result-label {
            color: #6b5b85;
            font-size: 14px;
            font-weight: 600;
        }

        .result-value {
            color: #6d28d9;
            font-weight: 700;
            font-size: 16px;
            overflow-wrap: anywhere;
        }

        .status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            background: #ede9fe;
            color: #6d28d9;
            font-size: 13px;
            font-weight: 700;
        }

        .footer {
            margin-top: 28px;
            text-align: center;
        }

        .back-button {
            display: inline-block;
            text-decoration: none;
            background: linear-gradient(135deg, #8b5cf6, #6d28d9);
            color: white;
            padding: 13px 24px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .back-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(109, 40, 217, 0.25);
        }

        .note {
            margin-top: 18px;
            color: #a397b9;
            font-size: 12px;
        }

        @media (max-width: 480px) {
            .utility-card {
                padding: 24px 18px;
            }

            .header h1 {
                font-size: 24px;
            }

            .result-list li {
                padding: 15px;
            }
        }
    </style>
</head>

<body>
    <main class="utility-card">
        <header class="header">
            <div class="icon">✦</div>
            <h1>Operator PHP</h1>
            <p>KursusKu · Hasil pengujian operator</p>
        </header>

        <ul class="result-list">
            <li>
                <span class="result-label">Perkalian</span>
                <span class="result-value">
                    Rp <?= number_format($subtotal, 0, ',', '.') ?>
                </span>
            </li>

            <li>
                <span class="result-label">Comparison &gt; 0</span>
                <span class="status">
                    <?= $comparisonPositive ? 'true' : 'false' ?>
                </span>
            </li>

            <li>
                <span class="result-label">Strict ===</span>
                <span class="status">
                    <?= $comparisonStrict ? 'true' : 'false' ?>
                </span>
            </li>

            <li>
                <span class="result-label">Concatenation</span>
                <span class="result-value">
                    <?= htmlspecialchars($message) ?>
                </span>
            </li>
        </ul>

        <footer class="footer">
            <a href="fee-calculator.php" class="back-button">
                ← Kembali ke Kalkulator
            </a>
            <p class="note">KursusKu · PHP Operator Test</p>
        </footer>
    </main>
</body>
</html>
