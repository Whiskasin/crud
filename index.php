<?php
use CloudCastle\Http\Router\Facade\Route;
use CloudCastle\Http\Router\Router;
use App\Controller\HomeController;
use App\Controller\TasksController;

require_once 'vendor/autoload.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$router = new Router();

// в принципе, надо бы разделять post,get, т.е. /tasks/create - post, /tasks/edit/id - put и т.д.
// Но в р рамках ТЗ указан 1 путь, так что оставляю как есть

Route::get('/', [HomeController::class, 'index']);
Route::get('/tasks/', [TasksController::class, 'index']);
Route::post('/tasks/', [TasksController::class, 'create']);
Route::get('/tasks/{id:\d+}', [TasksController::class, 'show']);
Route::put('/tasks/{id:\d+}', [TasksController::class, 'edit']);
Route::delete('/tasks/{id:\d+}', [TasksController::class, 'delete']);

// Переопределяем метод запроса если есть _method
$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'POST' && isset($_POST['_method'])) {
    $method = strtoupper($_POST['_method']);
    // Удаляем _method из POST чтобы не мешал
    unset($_POST['_method']);
}

try {
    $route = Route::dispatch($_SERVER['REQUEST_URI'], $method);
    list($controllerClass, $method) = $route->getAction();

    if (!class_exists($controllerClass)) {
        die("Ошибка: Класс ".$controllerClass." не найден.");
    }

    if (!method_exists($controllerClass, $method)) {
        die("Ошибка: Метод ".$method." не найден в классе ".$controllerClass);
    }

    // Создаем экземпляр и вызываем метод
    $controller = new $controllerClass();
    $result = call_user_func_array([$controller, $method], $route->getParameters());
} catch (Exception $e) {
    echo "Ошибка: ".$e->getMessage();
}