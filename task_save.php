<?php
session_start();
require 'dbcon.php';

// Delete Task
if (isset($_POST['delete_task'])) {
    $task_id = mysqli_real_escape_string($con, $_POST['delete_task']); 
    $query = "DELETE FROM tasks WHERE id='$task_id'";
    $query_run = mysqli_query($con, $query);
    
    if ($query_run) {
        $_SESSION['message'] = "Task deleted successfully";
        header("Location: index2.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Failed to delete task";
        header("Location: index2.php");
        exit(0);
    }
}

// Update Task
if (isset($_POST['update_task'])) {
    $task_id = mysqli_real_escape_string($con, $_POST['task_id']);
    $task = mysqli_real_escape_string($con, $_POST['task']);
    $status = mysqli_real_escape_string($con, $_POST['status']);

    $query = "UPDATE tasks SET task='$task', status='$status' WHERE id='$task_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Task updated successfully";
        header("Location: index2.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Failed to update task";
        header("Location: index2.php");
        exit(0);
    }
}

// Save Task
if (isset($_POST['save_task'])) {
    $task = mysqli_real_escape_string($con, $_POST['task']);
    $status = mysqli_real_escape_string($con, $_POST['status']);

    $query = "INSERT INTO tasks (task, status) VALUES ('$task', '$status')";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Task added successfully";
        header("Location: index2.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Failed to add task";
        header("Location: index2.php");
        exit(0);
    }
}
?>
