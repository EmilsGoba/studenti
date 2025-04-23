<?php
require "Validator.php";
auth();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (!Validator::string($_POST['first_name'], max: 50)) {
        $errors['first_name'] = "First name is required and must not exceed 50 characters.";
    }

    
    if (!Validator::string($_POST['last_name'], max: 50)) {
        $errors['last_name'] = "Last name is required and must not exceed 50 characters.";
    }

    
    if (!Validator::string($_POST['subject'], max: 100)) {
        $errors['subject'] = "Subject is required and must not exceed 100 characters.";
    }

    
    if (!Validator::string($_POST['grade'], max: 10)) {
        $errors['grade'] = "Grade is required and must not exceed 10 characters.";
    }

    
    if (empty($errors)) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $subject = $_POST['subject'];
        $grade = $_POST['grade'];

        if (!$userId) {
            $username = $first_name . '.' . $last_name . "@school.com";
            $username = strtolower($username);
            $first_name1 = strtolower(substr_replace($first_name, '', -2));
            $last_name1 = strtolower(substr_replace($last_name, '23', -3));
            $password = $first_name1 . $last_name1;
            $password = str_shuffle($password);
            $created_at = date('Y-m-d H:i:s');

            $sql = "INSERT INTO users (username, password, role, created_at) VALUES (:username, :password, :role, :created_at)";
            $params = [
                ':username' => $username,
                ':password' => $password,
                ':role' => 'student',
                ':created_at' => $created_at
            ];

            $users = $db->query($sql, $params);
        }
        if(!$subjectId){
            $sql = "INSERT INTO subjects (subjects_name) VALUES (:subject)";
            $params = [
                ':subject' => $subject
            ];
            $subjects = $db->query($sql, $params);

        }
    }
}

require "views/teacher/create.view.php";