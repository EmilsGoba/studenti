<?php
require "Validator.php";
auth();

$config = require("config.php");
$db = new Database($config['database'], 'root', ''); // Adjust credentials if needed

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Validate input
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
        $grade = intval($_POST['grade']);

        // Create unique username
        $username = strtolower($first_name . '.' . $last_name . '@school.com');

        // Check if user already exists
        $existingUser = $db->query("SELECT id FROM users WHERE username = ?", [$username])->fetch();
        if ($existingUser) {
            $userId = $existingUser['id'];
        } else {
            // Generate and hash password
            $passwordPlain = str_shuffle(
                strtolower(substr_replace($first_name, '', -2)) .
                strtolower(substr_replace($last_name, '23', -3))
            );
            $passwordHashed = password_hash($passwordPlain, PASSWORD_DEFAULT);

            // Insert into users
            $db->query("INSERT INTO users (username, password, role, created_at) VALUES (?, ?, 'student', ?)", [
                $username,
                $passwordPlain,
                date('Y-m-d H:i:s')
            ]);
            $userId = $db->lastInsertId();
        }

        // Insert into students table
        $db->query("INSERT INTO students (user_id, first_name, last_name) VALUES (?, ?, ?)", [
            $userId,
            $first_name,
            $last_name
        ]);
        $studentId = $db->lastInsertId();

        // Check or insert subject
        $existingSubject = $db->query("SELECT id FROM subjects WHERE subjects_name = ?", [$subject])->fetch();
        if ($existingSubject) {
            $subjectId = $existingSubject['id'];
        } else {
            $db->query("INSERT INTO subjects (subjects_name) VALUES (?)", [$subject]);
            $subjectId = $db->lastInsertId();
        }

        // Insert into grades
        $db->query("INSERT INTO grades (student_id, subject_id, grade) VALUES (?, ?, ?)", [
            $studentId,
            $subjectId,
            $grade
        ]);

        // Redirect after success
        header("Location: /teacher/dashboard");
        exit;
    }
}

require "views/teacher/create.view.php";
