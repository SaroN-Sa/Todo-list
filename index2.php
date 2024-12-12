<?php
session_start();
require 'dbcon.php';

// Handle alarm setting
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_id']) && isset($_POST['alarmTime'])) {
    $task_id = $_POST['task_id'];
    $alarm_time = $_POST['alarmTime'];

    // Validate task_id
    if (!filter_var($task_id, FILTER_VALIDATE_INT)) {
        echo "Error: Invalid task_id.";
        exit();
    }

    // Check if the task_id exists
    $checkStmt = $con->prepare("SELECT id FROM tasks WHERE id = ?");
    $checkStmt->bind_param("i", $task_id);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    if ($checkResult->num_rows === 0) {
        echo "Error: Task ID does not exist.";
        exit();
    }

    // Insert the new alarm
    $stmt = $con->prepare("INSERT INTO alarms (task_id, alarm_time) VALUES (?, ?)");
    $stmt->bind_param("is", $task_id, $alarm_time);
    if ($stmt->execute()) {
        echo "Alarm set successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Fetch tasks from the database
$sql = "SELECT id, task, status FROM tasks";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <style>
        /* Internal CSS for styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #e6e8ed;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative; /* Required for button positioning */
        }

        h1 {
            margin-top: 20px;
            text-align: center;
        }

        #id-1 {
            margin: 20px 0;
        }

        #id-1 p {
            font-size: 20px;
        }

        #id-1 a {
            text-decoration: none;
            background: #28a745;
            color: blue;
            padding: 1px 1px;
            border-radius: 5px;
        }

        span {
            display: flex;
            gap: 10px;
        }

        .div-1 {
            display: flex;
            justify-content: space-between;
            width: 80%;
            margin: 10px 0;
        }

        .div-1 input[type="number"],
        .div-1 input[type="search"] {
            padding: 5px;
        }

        .div-2 {
            width: 80%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        td:hover {
            background: #0056b3;
        }

        th {
            background-color: #f4f4f4;
        }

        .button1 {
            padding: 5px 10px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            text-decoration: none;
        }

        #aa {
            background-color: green;
        }

        #bb {
            background-color: yellow;
        }

        #cc {
            background-color: red;
        }

        .button1:hover {
            background: #0056b3;
        }

        form.d-inline {
            display: inline;
        }

        .alarm-form {
            margin-top: 20px;
        }

        /* Button arrow styling */
        .back-button {
            position: absolute;
            top: 20px;
            right: 20px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 50%;
            padding: 10px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .back-button:hover {
            background: #0056b3;
        }

        .back-button::before {
            content: '←';
            font-size: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <button class="back-button" onclick="window.location.href='passdash.php'"></button>

    <h1>To-Do List</h1>
    <div id="id-1">
        <?php include('message.php'); ?>
        <p>Manage Your Tasks</p>
        <span>
            <a href="add_task.php"><p class="Z">Add New Task</p></a> 
        </span>
    </div>
    <div class="div-1">
        <label for="show">Show <input type="number" name="number" value="1" min="1" id=""></label>
        <label for="search" id="la-1">Search <input type="search" name="search" id=""></label>
    </div>

    <div class="div-2">
        <table class="table" id="dataTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Task</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $row["id"]; ?></td>
                        <td><?php echo $row["task"]; ?></td>
                        <td><?php echo $row["status"] == 'completed' ? 'Completed' : 'Pending'; ?></td>
                        <td>
                            <a href="task-view.php?id=<?php echo $row['id']; ?>" class="button1" id="aa">View</a>
                            <a href="task_edit.php?id=<?php echo $row['id']; ?>" class="button1" id="bb">Update</a>
                            <a href="index2.php?id=<?php echo $row['id']; ?>" class="button1" id="cc">Set Alarm</a>
                            <form action="task_actions.php" method="POST" class="d-inline">
                                <button type="submit" name="delete_task" value="<?php echo $row['id']; ?>" class="button1">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='4'>No tasks found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <?php
        // Display alarm form if task_id is set in the URL
        if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
            $task_id = $_GET['id'];
            
            // Fetch task details (optional: display task details for confirmation)
            $query = "SELECT task FROM tasks WHERE id = ?";
            $stmt = $con->prepare($query);
            $stmt->bind_param("i", $task_id);
            $stmt->execute();
            $taskResult = $stmt->get_result();
            $task = $taskResult->fetch_assoc();
        ?>
            <div class="alarm-form">
                <h2>Set Alarm for Task: <?php echo htmlspecialchars($task['task']); ?></h2>
                <form action="index2.php" method="POST">
                    <input type="hidden" name="task_id" value="<?php echo htmlspecialchars($task_id); ?>">
                    <label for="alarmTime">Alarm Time:</label>
                    <input type="datetime-local" name="alarmTime" id="alarmTime" required>
                    <button type="submit" class="button1">Set Alarm</button>
                </form>
            </div>
        <?php
        }
        ?>
    </div>
</body>
</html>
