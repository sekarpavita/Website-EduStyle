<?php
require_once __DIR__ . '/../models/Question.php';

class QuestionController {
    private $questionModel;

    public function __construct() {
        $this->questionModel = new Question();
    }

    public function showQuestions() {
        $questions = $this->questionModel->getQuestions();
        include __DIR__ . '/../views/question_view.php';
    }

    public function processAnswers() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $answers = $_POST['answer'] ?? [];

            $this->questionModel->saveUserAnswers($answers);

            header("Location: /result"); // Halaman hasil
            exit();
        } else {
            header("Location: /question");
            exit();
        }
    }
}

?>