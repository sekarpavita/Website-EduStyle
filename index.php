<?php
session_start();

require_once 'controllers/QuestionController.php';
require_once 'models/Question.php';

$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($request_uri) {
    case '/':
        include __DIR__ . '/views/home.php';
        break;
    case '/question':
        $controller = new QuestionController();
        $controller->showQuestions();
        break;
    case '/submit-answers':
        $controller = new QuestionController();
        $controller->processAnswers();
        break; 
    case '/result':
        include __DIR__ . '/views/result.php';
        break;
    default:
        header("HTTP/1.0 404 Not Found");
        echo "<h1>404 Not Found</h1>";
        echo "<p>Halaman yang Anda cari tidak ditemukan</p>";
        break;
}

?>