<?php

auth();

$style = "css/grades.css";
$grades = [];

if ($_SESSION['role'] === 'student') {
    // Get the current student's ID using the logged-in user's ID
    $sql = "SELECT id FROM students WHERE user_id = :user_id";
    $params = ['user_id' => $_SESSION['user_id']];
    $student = $db->query($sql, $params)->fetch();

    if ($student) {
        $sql = "SELECT 
                    students.first_name,
                    students.last_name,
                    subjects.subjects_name,
                    grades.grade,
                    grades.created_at
                FROM grades
                JOIN students ON grades.student_id = students.id
                JOIN subjects ON grades.subject_id = subjects.id
                WHERE grades.student_id = :student_id
                ORDER BY grades.created_at DESC";

        $params = ['student_id' => $student['id']];
        $grades = $db->query($sql, $params)->fetchAll();
    }
} else {
    // For teachers or admins: show all grades
    $sql = "SELECT 
                students.first_name,
                students.last_name,
                subjects.subjects_name,
                grades.grade,
                grades.created_at
            FROM grades
            JOIN students ON grades.student_id = students.id
            JOIN subjects ON grades.subject_id = subjects.id
            ORDER BY grades.created_at DESC";

    $grades = $db->query($sql, [])->fetchAll();
}

require "views/grades.view.php";
