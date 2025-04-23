<?php require "views/partials/head.php"; ?>

<h2>Your Grades</h2>

<?php if (empty($grades)): ?>
    <p>You have no grades yet.</p>
<?php else: ?>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Subject</th>
                <th>Grade</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($grades as $grade): ?>
                <tr>
                    <td><?= htmlspecialchars($grade['subjects_name']) ?></td>
                    <td><?= htmlspecialchars($grade['grade']) ?></td>
                    <td><?= htmlspecialchars($grade['created_at']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php require "views/partials/footer.php"; ?>
