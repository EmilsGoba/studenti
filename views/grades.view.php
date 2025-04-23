<?php require "views/components/header.php";?>
<?php require "views/components/navbar.php";?>

<h2>All Student Grades</h2>
    <table>
        <thead>
            <tr>
                <th>Student</th>
                <th>Subject</th>
                <th>Grade</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($grades as $grade): ?>
                <tr>
                    <td><?= htmlspecialchars($grade['first_name']) . " " . htmlspecialchars($grade['last_name']) ?></td>
                    <td><?= htmlspecialchars($grade['subjects_name']) ?></td>
                    <td><?= htmlspecialchars($grade['grade']) ?></td>
                    <td><?= htmlspecialchars($grade['created_at']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
<?php require "views/components/footer.php";?>