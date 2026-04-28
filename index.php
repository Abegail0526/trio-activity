<?php
require 'db.php';

$stmt = $pdo->query("SELECT * FROM students");
$students = $stmt->fetchAll();
?>

<a href="create.php">Add New Student</a>
<br><br>

<table border="1">
    <tr>
        <th>ID</th><th>Name</th><th>Email</th><th>Course</th><th>Actions</th>
    </tr>
    <?php foreach ($students as $s): ?>
    <tr>
        <td><?= $s['id'] ?></td>
        <td><?= htmlspecialchars($s['name']) ?></td>
        <td><?= htmlspecialchars($s['email']) ?></td>
        <td><?= htmlspecialchars($s['course']) ?></td>
        <td>
            <a href="edit.php?id=<?= $s['id'] ?>">Edit</a>
            <form action="delete.php" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this student?');">
                <input type="hidden" name="id" value="<?= $s['id'] ?>">
                <!-- Style the button to look like a link for consistency -->
                <button type="submit" style="background:none; border:none; color:blue; cursor:pointer; text-decoration:underline; padding:0;">Delete</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>