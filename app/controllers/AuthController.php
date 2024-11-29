<?php

namespace app\controllers;

use app\dbhelper; // Assuming you have a dbhelper class to interact with the database.

class AuthController
{
    public function loginForm()
    {
        require_once __DIR__ . '/../views/auth/login.php';
    }

    public function validateLogin()
    {
        // Check if POST request is made
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            if (!empty($username) && !empty($password)) {
                // Here, query the database to check user credentials.
                $db = new dbConnection(); // Assuming you have dbhelper for DB connection.
                $user = $db->getUserByUsername($username); // Make sure this function exists.

                if ($user && password_verify($password, $user['password'])) {
                    // Set session variables if login is successful
                    session_start();
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];

                    // Redirect to room_manage page after successful login
                    header("Location: /finalprojectphpoop/views/layout/room_manage.php");
                    exit;
                } else {
                    // Invalid login credentials, redirect to login page with an error
                    $_SESSION['error'] = "Invalid username or password!";
                    header("Location: /finalprojectphpoop/views/auth/login.php");
                    exit;
                }
            } else {
                // Missing fields, redirect to login page with an error
                $_SESSION['error'] = "Please fill in both fields!";
                header("Location: /finalprojectphpoop/views/auth/login.php");
                exit;
            }
        } else {
            // If not POST request, redirect back to login
            header("Location: /finalprojectphpoop/views/auth/login.php");
            exit;
        }
    }
}
