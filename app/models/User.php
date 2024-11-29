<?php

namespace app\models;

require_once __DIR__ . '/../../app/dbhelper.php';

class User
{
    public static function findByEmail($email)
    {
        $pdo = dbConnection();
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$email]);
        return $stmt->fetch();
    }
}
