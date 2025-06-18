<?php

class Question {
    public function getQuestions() {
        $jsonFilePath = __DIR__ . '/json/questions.json';

        if (!file_exists($jsonFilePath)) {
            error_log("Error: File questions.json tidak ditemukan di " . $jsonFilePath);
            return [];
        }

        $jsonData = file_get_contents($jsonFilePath);
        $questions = json_decode($jsonData, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log("Error decoding JSON: " . json_last_error_msg());
            return [];
        }

        return $questions;
    }

    public function saveUserAnswers(array $answers) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['user_answers'] = $answers;
    }
}

?>