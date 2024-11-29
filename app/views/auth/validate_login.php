<?php
session_start();
require_once __DIR__ . '/../../app/dbhelper.php'; // Adjust the path if needed

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        try {
            // Prepare statement to fetch user based on username
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                // Successful login
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                // Redirect to the room management page
                header("Location: /finalprojectphpoop/views/layout/room_manage.php");
                exit;
            } else {
                // Invalid credentials
                $_SESSION['error'] = "Invalid username or password.";
                header("Location: /finalprojectphpoop/views/auth/login.php");
                exit;
            }
        } catch (PDOException $e) {
            // Handle database errors
            $_SESSION['error'] = "Error: " . $e->getMessage();
            header("Location: /finalprojectphpoop/views/auth/login.php");
            exit;
        }
    } else {
        $_SESSION['error'] = "Please fill in both fields.";
        header("Location: /finalprojectphpoop/views/auth/login.php");
        exit;
    }
} else {
    // Invalid request method
    $_SESSION['error'] = "Invalid request method.";
    header("Location: /finalprojectphpoop/views/auth/login.php");
    exit;
}
