<?php
session_start();
require 'dbcon.php';

// Delete Task
if (isset($_POST['delete_task'])) {
    $task_id = $_POST['delete_task'];

    // Check if task_id is numeric to prevent SQL injection
    if (is_numeric($task_id)) {
        $stmt = $con->prepare("DELETE FROM tasks WHERE id=?");
        $stmt->bind_param("i", $task_id);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Task deleted successfully";
        } else {
            $_SESSION['message'] = "Failed to delete task: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['message'] = "Invalid task ID";
    }

    header("Location: index2.php");
    exit(0);
}

// Update Task
if (isset($_POST['update_task'])) {
    $task_id = $_POST['task_id'];
    $task = $_POST['task'];
    $status = $_POST['status'];

    // Check if task_id is numeric
    if (is_numeric($task_id)) {
        $stmt = $con->prepare("UPDATE tasks SET task=?, status=? WHERE id=?");
        $stmt->bind_param("ssi", $task, $status, $task_id);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Task updated successfully";
        } else {
            $_SESSION['message'] = "Failed to update task: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['message'] = "Invalid task ID";
    }

    header("Location: index2.php");
    exit(0);
}

// Add New Task
if (isset($_POST['save_task'])) {
    $task = $_POST['task'];
    $status = $_POST['status'];

    // Validate task and status fields if needed
    if (!empty($task) && !empty($status)) {
        $stmt = $con->prepare("INSERT INTO tasks (task, status) VALUES (?, ?)");
        $stmt->bind_param("ss", $task, $status);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Task added successfully";
        } else {
            $_SESSION['message'] = "Failed to add task: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['message'] = "Task and status cannot be empty";
    }

    header("Location: index2.php");
    exit(0);
}
?>
