<?php
guest();
require "Validator.php";

$errors = [];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $errors[] = "Username and password are required.";
    } else {
        $sql = "SELECT * FROM users WHERE username = :username LIMIT 1";
        $params = ['username' => $username];
        $result = $db->query($sql, $params)->fetch();

        if ($result) { 
            if (password_verify($password, $result['password']) || $password === $result['password']) {
                $_SESSION['logged_in'] = true;
                $_SESSION['user_id'] = $result['id'];
                $_SESSION['username'] = $result['username'];
                $_SESSION['role'] = $result['role'];

                header("Location: /");
                exit;
            } else {
                $errors[] = "Nepareiza parole";
            }
        } else {
            $errors[] = "Lietotājs nav atrasts";
        }
    }
}

require "views/auth/login.view.php";
