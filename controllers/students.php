<?php

auth();

$config = require("config.php");
$db = new Database($config['database'], 'root', '');

// Use DISTINCT to avoid duplicates at the SQL level
$sql = "SELECT DISTINCT
            students.first_name,
            students.last_name,
            users.username,
            users.plain_password
        FROM students
        JOIN users ON students.user_id = users.id
        ORDER BY students.last_name ASC";

$students = $db->query($sql, [])->fetchAll();

/* Optional PHP filtering — in case DISTINCT isn't enough
$unique = [];
$filtered_students = [];

foreach ($students as $student) {
    $key = $student['username']; // or use 'user_id' if available
    if (!in_array($key, $unique)) {
        $unique[] = $key;
        $filtered_students[] = $student;
    }
}

$students = $filtered_students;
*/

require "views/students.view.php";
