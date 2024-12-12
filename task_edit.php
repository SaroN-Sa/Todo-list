<?php
session_start();
require 'dbcon.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .button2 {
            display: inline-block;
            padding: 10px 15px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .button2:hover {
            background-color: #0056b3;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #218838;
        }

        .message {
            padding: 10px;
            background-color: #f8d7da;
            color: #721c24;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
        }

        .new {
            margin-top: 20px;
        }
        h2 a {
    margin-left: 80%;
}
    </style>
</head>
<body>
    <div class="container">
        <?php include('message.php'); ?>
        <h2>Edit Task
            <a href="index2.php" class="button2">Back</a>
        </h2>
        <div class="new">
            <?php
            if (isset($_GET['id'])) {
                $task_id = mysqli_real_escape_string($con, $_GET['id']);

                // Ensure task ID is an integer
                if (is_numeric($task_id)) {
                    $sql = "SELECT id, task, status FROM tasks WHERE id='$task_id'";
                    $result = mysqli_query($con, $sql);

                    if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        ?>
                        <form action="task_actions.php" method="post">
                            <input type="hidden" name="task_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                            <div class="form-group">
                                <label for="task">Task</label>
                                <input type="text" name="task" id="task" value="<?php echo htmlspecialchars($row['task']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" required>
                                    <option value="pending" <?php echo ($row['status'] == 'pending' ? 'selected' : ''); ?>>Pending</option>
                                    <option value="completed" <?php echo ($row['status'] == 'completed' ? 'selected' : ''); ?>>Completed</option>
                                </select>
                            </div>
                            <button type="submit" name="update_task">Update Task</button>
                        </form>
                        <?php
                    } else {
                        echo "<p>No task found with the given ID.</p>";
                    }
                } else {
                    echo "<p>Invalid task ID format.</p>";
                }
            } else {
                echo "<p>Invalid request. No task ID provided.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
