<?php require "views/components/header.php";?>
<?php require "views/components/navbar.php";?>

<h1>Student Accounts</h1>

<?php if (!empty($students)): ?>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Username</th>
                <th>Password</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= htmlspecialchars($student['first_name'] . ' ' . $student['last_name']) ?></td>
                    <td><?= htmlspecialchars($student['username']) ?></td>
                    <td><?= htmlspecialchars($student['plain_password']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No students found.</p>
<?php endif; ?>

<style>
table {
    border-collapse: collapse;
    width: 100%;
    margin-top: 20px;
}
th, td {
    padding: 10px;
    border: 1px solid #ccc;
    text-align: left;
}
thead {
    background-color: #f4f4f4;
}
</style>

<?php require "views/components/footer.php";?>
