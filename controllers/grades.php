<?php

auth();

$style = "css/grades.css";
// Join grades with students and subjects
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
$params = [];
$grades = $db->query($sql, $params)->fetchAll();

require "views/grades.view.php";