<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planner's Dashboard</title>
    <!-- Internal CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .main-container {
            padding: 20px;
        }
        .main-title {
            margin-bottom: 20px;
        }
        .font-weight-bold {
            font-weight: bold;
            color: #333;
        }
        .main-cards {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }
        .card {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            flex: 1;
            min-width: 200px;
            max-width: 250px;
            text-align: center;
        }
        .card-inner {
            margin-bottom: 10px;
        }
        .text-primary {
            color: #007bff;
        }
        .text-blue {
            color: #007bff;
        }
        .text-orange {
            color: #fd7e14;
        }
        .text-green {
            color: #28a745;
        }
        .font-weight-bold {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <!-- Main -->
    <main class="main-container">
        <div class="main-title">
            <p class="font-weight-bold">PLANNER'S DASHBOARD</p>
        </div>

        <div class="main-cards">

            <a href="add_task.php" style="text-decoration:none" target="_blank">
                <div class="card">
                    <div class="card-inner">
                        <p class="text-primary">New Task</p>
                        <span class="material-icons-outlined text-blue"></span>
                    </div>
                    <span class="text-primary font-weight-bold">0</span>
                </div>
            </a>

            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">View Task</p>
                    <span class="material-icons-outlined text-orange"></span>
                </div>
                <span class="text-primary font-weight-bold">0</span>
            </div>

            <div class="card">
                <div class="card-inner">
                    <p class="text-primary">PERSONAL</p>
                    <span class="material outlined text-green"></span>
                </div>
                <span class="text-primary font-weight-bold">0</span>
            </div>

        </div>
    </main>

    <!-- Internal JavaScript -->
    <script>
        // Example: Function to update task counts dynamically
        function updateTaskCount(taskCount) {
            const taskCountElements = document.querySelectorAll('.card span.font-weight-bold');
            taskCountElements.forEach(element => {
                element.textContent = taskCount;
            });
        }

        // Call the function with a sample count
        updateTaskCount(5);
    </script>
</body>
</html>