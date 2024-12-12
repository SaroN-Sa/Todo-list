<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task</title>
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
            position: relative;
        }

        .container {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            position: relative;
        }

        h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #333;
            position: relative;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="datetime-local"], select {
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

        /* Back button styles */
        .back-button {
            display: inline-block;
            width: 40px;
            height: 40px;
            background: #007bff;
            color: white;
            text-align: center;
            line-height: 40px;
            border-radius: 50%;
            font-size: 20px;
            text-decoration: none;
            position: absolute;
            top: 10px;
        }

        .back-button:hover {
            background: #0056b3;
        }

        .back-button.left-top {
            left: 10px;
        }

        .back-button.right-top {
            right: 10px;
        }

        .back-button.left-top::after {
            content: '←'; /* Arrow pointing left */
        }

        .back-button.right-top::after {
            content: '←'; /* Arrow pointing left */
        }

        .back-button-tooltip {
            display: none;
            position: absolute;
            background-color: #333;
            color: #fff;
            padding: 5px;
            border-radius: 3px;
            font-size: 12px;
            top: 50%;
            transform: translate(-50%, -50%);
            white-space: nowrap;
        }

        .back-button:hover .back-button-tooltip {
            display: block;
        }

        .back-button.left-top .back-button-tooltip {
            left: 150%;
        }

        .back-button.right-top .back-button-tooltip {
            right: 150%;
        }
    </style>
</head>
<body>
    <a href="passdash.php" class="back-button right-top">
        <span class="back-button-tooltip">Go to Dashboard</span>
    </a>
    <div class="container">
        <?php include('message.php'); ?>
        <div class="row">
            <div class="col">
                <h2>Add Task
                    <a href="index2.php" class="back-button left-top">
                        <span class="back-button-tooltip">Back to Tasks</span>
                    </a>
                </h2>
                <form action="task_save.php" method="post">
                    <div class="form-group">
                        <label for="task">Task</label>
                        <input type="text" name="task" id="task" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" required>
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                    <button type="submit" name="save_task">Save Task</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
