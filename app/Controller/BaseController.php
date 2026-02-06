<?php
namespace App\Controller;

abstract class BaseController {
    protected function render($view, $data = []) {
        $content = "app/View/{$view}.php";

        // Проверяем существование файла
        if (!file_exists($content)) {
            throw new \Exception("View file not found: {$content}");
        }

        // Извлекаем переменные
        extract($data);

        // Подключаем layout
        include 'app/View/layout.php';
    }

    protected function redirect($url)
    {
        header('Location: '.$url);
        exit;
    }
}