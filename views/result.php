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

        $visual_score = isset($_GET['visual']) ? floatval($_GET['visual']) : 0;
        $auditori_score = isset($_GET['auditori']) ? floatval($_GET['auditori']) : 0;
        $kinestetik_score = isset($_GET['kinestetik']) ? floatval($_GET['kinestetik']) : 0;

        $total_scores_sum = $visual_score + $auditori_score + $kinestetik_score;

        if ($total_scores_sum > 0) {
            $visual_score_normalized = ($visual_score / $total_scores_sum) * 100;
            $auditori_score_normalized = ($auditori_score / $total_scores_sum) * 100;
            $kinestetik_score_normalized = ($kinestetik_score / $total_scores_sum) * 100;
        } else {
            $visual_score_normalized = 0;
            $auditori_score_normalized = 0;
            $kinestetik_score_normalized = 0;
        }

        $scores = [
            'Visual' => $visual_score_normalized,
            'Auditori' => $auditori_score_normalized,
            'Kinestetik' => $kinestetik_score_normalized
        ];

        $dominance_threshold = 30;

        $dominant_styles_by_threshold = [];
        foreach ($scores as $style => $score) {
            if ($score >= $dominance_threshold) {
                $dominant_styles_by_threshold[] = $style;
            }
        }

        $count_dominant_by_threshold = count($dominant_styles_by_threshold);

        $page_title_text = "Hasil Gaya Belajar Anda";
        $recommendation_html = "";

        $styles_info = [
            'Visual' => [
                'desc' => 'Anda belajar terbaik melalui pengamatan dan visualisasi',
                'recs' => [
                    'Gunakan peta pikiran (mind map) dan diagram untuk memahami konsep.',
                    'Manfaatkan video pembelajaran, infografis, dan presentasi visual.',
                    'Buat catatan dengan warna, highlight, dan simbol yang berbeda.',
                    'Gunakan flashcards dengan gambar atau sketsa.'
                ]
            ],
            'Auditori' => [
                'desc' => 'Anda efektif belajar melalui pendengaran dan diskusi',
                'recs' => [
                    'Ikuti diskusi kelompok, dengarkan penjelasan guru, dan gunakan rekaman audio.',
                    'Ajarkan materi ke orang lain atau diskusikan konsep secara lisan.',
                    'Manfaatkan podcast edukasi dan buku audio.',
                    'Bacalah materi dengan bersuara atau ulangi informasi yang Anda dengar.'
                ]
            ],
            'Kinestetik' => [
                'desc' => 'Anda belajar optimal melalui praktik langsung',
                'recs' => [
                    'Libatkan diri dalam praktik langsung, eksperimen, dan simulasi.',
                    'Bergerak, berjalan-jalan kecil, atau membuat catatan fisik/diagram saat belajar.',
                    'Gunakan alat peraga atau model untuk memahami konsep.',
                    'Lakukan studi kasus, proyek, atau role-playing yang melibatkan aktivitas fisik.'
                ]
            ]
        ];

        if ($count_dominant_by_threshold == 0) {
            $page_title_text .= ": Belum Teridentifikasi Jelas";
            $recommendation_html .= "<h2>Tidak ada gaya belajar dominan yang teridentifikasi secara jelas.</h2>";
            $recommendation_html .= "<p>Pastikan Anda telah menjawab kuesioner dengan jujur dan lengkap. Anda mungkin memiliki gaya belajar yang seimbang, atau perlu mencoba berbagai metode untuk menemukan yang paling cocok.</p>";
        } elseif ($count_dominant_by_threshold == 3) {
            $page_title_text .= " Dominan Campuran (Visual, Auditori, Kinestetik)";
            $recommendation_html .= "<h2>Rekomendasi Metode Belajar Berdasarkan Gaya Belajar Campuran:</h2>";
            
            $all_styles_ordered = ['Visual', 'Auditori', 'Kinestetik'];
            foreach ($all_styles_ordered as $style) {
                $recommendation_html .= "<h3>" . $style . ":</h3>";
                $recommendation_html .= "<ul>";
                foreach ($styles_info[$style]['recs'] as $rec) {
                    $recommendation_html .= "<li>" . $rec . "</li>";
                }
                $recommendation_html .= "</ul>";
            }
        } elseif ($count_dominant_by_threshold == 2) {
            sort($dominant_styles_by_threshold); 
            $page_title_text .= " Dominan " . implode(" dan ", $dominant_styles_by_threshold);
            $recommendation_html .= "<h2>Rekomendasi Metode Belajar untuk Gaya Belajar " . implode(" dan ", $dominant_styles_by_threshold) . ":</h2>";
            
            foreach ($dominant_styles_by_threshold as $style) {
                $recommendation_html .= "<h3>" . $style . ":</h3>";
                $recommendation_html .= "<ul>";
                foreach ($styles_info[$style]['recs'] as $rec) {
                    $recommendation_html .= "<li>" . $rec . "</li>";
                }
                $recommendation_html .= "</ul>";
            }
        } else {
            $single_dominant_style = $dominant_styles_by_threshold[0];
            $page_title_text .= " Dominan " . $single_dominant_style;
            $recommendation_html .= "<h2>Rekomendasi Metode Belajar Berdasarkan Gaya Belajar " . $single_dominant_style . ":</h2>";
            $recommendation_html .= "<ul>";
            foreach ($styles_info[$single_dominant_style]['recs'] as $rec) {
                $recommendation_html .= "<li>" . $rec . "</li>";
            }
            $recommendation_html .= "</ul>";
        }
    ?>

    <div class="site-wrapper">
        <h1 class="page-title"><?php echo $page_title_text; ?></h1>
        <p>Kenali dan Maksimalkan Potensi Belajar Anda</p>

        <div style="width: 40%; margin: 5% auto;">
            <canvas id="myPieChart"></canvas>
        </div>

        <div class="summary">
            <div class="result-item">
                <div class="icon-text-box">
                    <img class="icon" src="../assets/image/logo_visual.png" alt="Visual">
                    <div class="info">
                        <h2>Visual</h2>
                        <p class="percentage" id="visual-percentage"><?php echo round($visual_score_normalized, 2); ?>%</p>
                    </div>
                </div>
                <p><?php echo $styles_info['Visual']['desc']; ?></p>
            </div>
            <div class="result-item">
                <div class="icon-text-box">
                    <img class="icon" src="../assets/image/logo_auditori.png" alt="Auditori">
                    <div class="info">
                        <h2>Auditori</h2>
                        <p class="percentage" id="auditori-percentage"><?php echo round($auditori_score_normalized, 2); ?>%</p>
                    </div>
                </div>
                <p><?php echo $styles_info['Auditori']['desc']; ?></p>
            </div>
            <div class="result-item">
                <div class="icon-text-box">
                    <img class="icon" src="../assets/image/logo_kinestetik.png" alt="Kinestetik">
                    <div class="info">
                        <h2>Kinestetik</h2>
                        <p class="percentage" id="kinestetik-percentage"><?php echo round($kinestetik_score_normalized, 2); ?>%</p>
                    </div>
                </div>
                <p><?php echo $styles_info['Kinestetik']['desc']; ?></p>
            </div>
        </div>

        <div class="recommendation">
            <?php echo $recommendation_html; ?>
        </div>

        <div class="buttons">
            <button onclick="window.location.href='/question'">Ulangi Tes</button>
            <button onclick="window.location.href='/'">Kembali ke Beranda</button>
        </div>
    </div>

    <?php
        include __DIR__ . '/components/footer.php';
    ?>
    <script>
        window.learningStyleData = {
            visual: <?php echo json_encode(round($visual_score_normalized, 2)); ?>,
            auditori: <?php echo json_encode(round($auditori_score_normalized, 2)); ?>,
            kinestetik: <?php echo json_encode(round($kinestetik_score_normalized, 2)); ?>
        };
    </script>
    <script src="../assets/js/result_chart.js"></script>
</body>
</html>