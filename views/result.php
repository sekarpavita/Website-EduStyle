<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Gaya Belajar</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/result_style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <?php
        include __DIR__ . '/components/header.php';
    ?>

    <div class="site-wrapper">
        <h1 class="page-title">Hasil Gaya Belajar Anda Dominan Visual</h1>
        <p>Kenali dan Maksimalkan Potensi Belajar Anda</p>

            <div style="width: 40%; margin: 5%;">
                <canvas id="myPieChart"></canvas>
            </div>

            <div class="summary">
                <div class="result-item">
                    <div class="icon-text-box"> 
                        <img class="icon" src="../assets/image/logo_visual.png" alt="Visual">
                        <div class="info">
                            <h2>Visual</h2>
                            <p class="percentage">45%</p>
                        </div>
                    </div>
                    <p>Anda belajar terbaik melalui pengamatan dan visualisasi</p>
                </div>
                <div class="result-item">
                    <div class="icon-text-box">
                        <img class="icon" src="../assets/image/logo_auditori.png" alt="Auditori">
                        <div class="info">
                            <h2>Auditori</h2>
                            <p class="percentage">30%</p>
                        </div>
                    </div>
                    <p>Anda efektif belajar melalui pendengaran dan diskusi</p>
                </div>
                <div class="result-item">
                    <div class="icon-text-box">
                        <img class="icon" src="../assets/image/logo_kinestetik.png" alt="Kinestetik">
                        <div class="info">
                            <h2>Kinestetik</h2>
                            <p class="percentage">25%</p>
                        </div>
                    </div>
                    <p>Anda belajar optimal melalui praktik langsung</p>
                </div>
            </div>

        <div class="recommendation">
            <h2>Rekomendasi Metode Belajar Berdasarkan Gaya Belajar Visual:</h2>
            <ul>
                <li>Gunakan peta pikiran dan diagram untuk memahami konsep</li>
                <li>Manfaatkan video pembelajaran dan infografis</li>
                <li>Buat catatan dengan warna dan simbol yang berbeda</li>
            </ul>
        </div>

        <div class="buttons">
            <button onclick="window.location.href='/question'">Ulangi Tes</button>
            <button onclick="window.location.href='/'">Kembali ke Beranda</button>
        </div>
    </div>

    <?php
        include __DIR__ . '/components/footer.php';
    ?>
    <script src="../assets/js/result_chart.js"></script>
</body>
</html>
