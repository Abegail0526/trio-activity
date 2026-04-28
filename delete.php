<?php
/**
 * delete.php
 * Handles the deletion of a record from the database.
 */

// Include the database connection file
require 'db.php';

// 1. Validate the input
// It's best practice to use POST for deletions to prevent accidental triggers via URL
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int) $_POST['id'];

    if ($id > 0) {
        try {
            // 2. Prepare and execute the delete statement
            // Assuming the table is 'students' based on index.php context
            $sql = "DELETE FROM students WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $id]);

            // 3. Redirect back to the main list with a success message
            header("Location: index.php?status=deleted");
            exit;
        } catch (PDOException $e) {
            // Handle deletion errors (e.g., foreign key constraints)
            // In a real application, you might log this error and redirect with an error message
            die("Error deleting record: " . $e->getMessage());
        }
    }
}

// If accessed incorrectly (e.g., directly via URL or without an ID), redirect to index
header("Location: index.php");
exit;