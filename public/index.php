<?php
// index.php
session_start();

// Include the autoloader and controller
require_once __DIR__ . '/../includes/autoload.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';

use app\controllers\AuthController;

$request = strtok($_SERVER['REQUEST_URI'], '?');
$controller = new AuthController();

// Handle routes
if ($request === '/finalprojectphpoop/' || $request === '/finalprojectphpoop') {
    header("Location: /finalprojectphpoop/views/auth/login.php");
    exit;
} elseif ($request === '/finalprojectphpoop/views/auth/login.php') {
    $controller->loginForm();
} elseif ($request === '/finalprojectphpoop/views/auth/validate_login') {
    $controller->validateLogin();  // Calls the validation logic
} else {
    http_response_code(404);
    echo "404 Not Found";
}

