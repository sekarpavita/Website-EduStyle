<?php
$question_json_path = __DIR__ . '/../assets/json/question.json';
if (!file_exists($question_json_path)) {
    die("Error: questions.json not found at " . $question_json_path);
}
$questions_data = file_get_contents($question_json_path);
$questions = json_decode($questions_data, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die("Error decoding questions.json: " . json_last_error_msg());
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduStyle - Identifikasi Gaya Belajar</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="site-wrapper">
        <?php
            include __DIR__ . '/components/header.php';
        ?>
        <div class="container">
            <main class="main-content">
                <h2 class="page-title">Identifikasi Gaya Belajar Anda</h2>
                <p class="description">Jawab setiap pernyataan sesuai dengan kebiasaan belajar Anda</p>

                <form id="learningStyleForm" class="question-form">
                    <?php foreach ($questions as $index => $question): ?>
                    <div class="question-block">
                        <div class="question-number"><?php echo $index + 1; ?></div>
                        <div class="question-text">
                            <p><?php echo $question['text']; ?></p>
                            <div class="options-group">
                                <label class="radio-label">
                                    <input type="radio" name="answer[<?php echo $question['id']; ?>]" value="1" required>
                                    <span class="custom-radio"></span>
                                    Sangat Tidak Setuju
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="answer[<?php echo $question['id']; ?>]" value="2">
                                    <span class="custom-radio"></span>
                                    Tidak Setuju
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="answer[<?php echo $question['id']; ?>]" value="3">
                                    <span class="custom-radio"></span>
                                    Netral
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="answer[<?php echo $question['id']; ?>]" value="4">
                                    <span class="custom-radio"></span>
                                    Setuju
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="answer[<?php echo $question['id']; ?>]" value="5">
                                    <span class="custom-radio"></span>
                                    Sangat Setuju
                                </label>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                    <div class="form-actions">
                        <button type="submit" class="submit-button">
                            Hasil <span class="arrow-icon">&#10140;</span>
                        </button>
                    </div>
                </form>
            </main>
        </div>
    </div>
    <?php
        include __DIR__ . '/components/footer.php';
    ?>
    <script src="assets/js/question_handler.js"></script>
</body>
</html>