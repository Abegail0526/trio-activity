<?php
require 'db.php';

$stmt = $pdo->query("SELECT * FROM students ORDER BY id DESC");
$students = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Student Records</h2>
        <a href="create.php" class="btn btn-primary">
            + Add Student
        </a>
    </div>

    <!-- Empty State -->
    <?php if (empty($students)): ?>
        <div class="alert alert-info text-center">
            No students available yet.
        </div>
    <?php else: ?>

    <!-- Table -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Course</th>
                            <th class="text-center" style="width: 180px;">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($students as $s): ?>
                            <tr>
                                <td><?= (int)$s['id'] ?></td>
                                <td><?= htmlspecialchars($s['name']) ?></td>
                                <td><?= htmlspecialchars($s['email']) ?></td>
                                <td><?= htmlspecialchars($s['course']) ?></td>
                                <td class="text-center">

                                    <a href="edit.php?id=<?= (int)$s['id'] ?>"
                                       class="btn btn-sm btn-warning me-1">
                                        Edit
                                    </a>

                                    <form action="delete.php" method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Delete this student?');">

                                        <input type="hidden" name="id" value="<?= (int)$s['id'] ?>">

                                        <button type="submit" class="btn btn-sm btn-danger">
                                            Delete
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <?php endif; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>