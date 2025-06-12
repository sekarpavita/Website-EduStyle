<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduStyle</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/home_style.css">
</head>
<body>
    <div class="site-wrapper">
        <?php
            include __DIR__ . '/components/header.php';
        ?>
        <main class="main-content"> 
            <section class="hero">
                <div class="container">
                    <div class="hero-text">
                        <h1 class="homepage-title">Temukan Gaya Belajar <br>Unik Anda</h1>
                        <p class>Kenali cara belajar terbaik untuk hasil maksimal</p> 
                        <p class>Tes singkat 10 menit untuk mengidentifikasi apakah Anda pembelajar Visual, Auditori, atau Kinestetik</p> 
                    </div>
                    <div class="hero-image">
                        <img src="../assets/image/learning_image.png" alt="Learning Image">
                    </div>
                </div>
            </section>
 
            <section class="learning-styles">
                <div class="container">
                    <h2 class="page-title">Tiga Gaya Belajar Utama</h2>
                    <div class="learning-styles-container">
                        <div class="learning-style-item">
                            <img src="../assets/image/logo_visual.png" alt="Visual">
                            <h3>Visual</h3>
                            <p>Belajar melalui gambar, diagram, dan visualisasi</p>
                        </div>
                        <div class="learning-style-item">
                            <img src="../assets/image/logo_auditori.png" alt="Auditori">
                            <h3>Auditori</h3>
                            <p>Belajar melalui mendengarkan dan diskusi</p>
                        </div>
                        <div class="learning-style-item">
                            <img src="../assets/image/logo_kinestetik.png" alt="Kinestetik">
                            <h3>Kinestetik</h3>
                            <p>Belajar melalui praktik dan pengalaman langsung</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="cta">
                <div class="container">
                    <h2 class="page-title">Coba sekarang dan tingkatkan kemampuan belajar Anda secara optimal</h2>
                    <p>Bergabunglah sekarang dan raih potensi belajar terbaik Anda</p>
                    <button class="cta-button" onclick="window.location.href='/question'">Mulai Tes</button>
                </div>
            </section>
        </main>
    </div>
    <?php
        include __DIR__ . '/components/footer.php';
    ?>
</body>
</html>
