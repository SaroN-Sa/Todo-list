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
        /* Internal CSS for styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background: #218838;
        }

        .button2 {
            background-color: #007bff;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="container">
        
        <div class="row">
            <div class="col">
                <h2> your Task
                    
                </h2>
                <div class="new">
                    <?php
                    if (isset($_GET['id'])) {
                        $task_id = intval($_GET['id']); // Convert to integer for security

                        // Prepare and execute the query
                        if ($stmt = $con->prepare("SELECT * FROM tasks WHERE id=?")) {
                            $stmt->bind_param("i", $task_id);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result && $result->num_rows > 0) {
                                $task = $result->fetch_assoc();
                                ?>
                                <form action="index2.php" method="post">
                                    <input type="hidden" name="task_id" value="<?php echo htmlspecialchars($task['id']); ?>">
                                    <div class="form-group">
                                        <label for="task">Task</label>
                                        <input type="text" name="task" id="task" value="<?php echo htmlspecialchars($task['task']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" required>
                                            <option value="pending" <?php echo ($task['status'] == 'pending' ? 'selected' : ''); ?>>Pending</option>
                                            <option value="completed" <?php echo ($task['status'] == 'completed' ? 'selected' : ''); ?>>Completed</option>
                                        </select>
                                    </div>
                                    <button type="submit" name="task_view">Back</button>
                                </form>
                                <?php
                            } else {
                                echo "No task found with the given ID";
                            }

                            $stmt->close();
                        } else {
                            echo "Failed to prepare the SQL statement: " . $con->error;
                        }
                    } else {
                        echo "No ID provided";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
