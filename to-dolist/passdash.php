<?php
session_start();
include 'dbcon.php';

// Check if a new theme was submitted
if (isset($_POST['theme'])) {
    $theme = $_POST['theme'];
    $_SESSION['theme'] = $theme;
}

// Retrieve theme preference from session or default to light mode
$theme = isset($_SESSION['theme']) ? $_SESSION['theme'] : 'light-mode';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>

    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="passdash.css">

    <style>
        body.<?php echo $theme; ?> {
            background-color: <?php echo ($theme === 'dark-mode') ? '#333' : '#f4f4f4'; ?>;
            color: <?php echo ($theme === 'dark-mode') ? '#f4f4f4' : '#333'; ?>;
        }
    </style>
</head>

<body class="<?php echo $theme; ?>">
    <div class="grid-container">
        <!-- Header -->
        <header class="header">
            <div class="menu-icon" onclick="openSidebar()">
                <span class="material-icons-outlined">menu</span>
            </div>
            <div class="header-left">
                <span style="display: inline-block; margin-right: 300px;">TODO LIST ACTION PLANER</span>
                <span style="display: inline-block;">
                    <?php
                    // Check if session variable 'ID' is set
                    if (isset($_SESSION["ID"])) {
                        $ID = $_SESSION["ID"];
                        
                        // Prepare and execute the database query
                        $sql = mysqli_query($conn, "SELECT * FROM register WHERE ID='$ID'");
                        
                        // Check if the query returned results
                        if (mysqli_num_rows($sql) > 0) {
                            $row = mysqli_fetch_array($sql);
                            // Display the welcome message and user's name
                            echo "<p class='hint-text'><br><b>Welcome: {$row['First_Name']}</b></p>";
                        } else {
                            // Error message if no matching user found
                            echo "No user found with ID: $ID";
                        }
                    } else {
                        // Error message if session variable 'ID' is not set
                        echo "Session variable 'ID' not set";
                    }
                    ?>
                </span>
            </div>
            <div class="header-right">
                <span class="material-icons-outlined">notifications</span>
                <span class="material-icons-outlined">email</span>
                <span class="material-icons-outlined">account_circle</span>
            </div>
        </header>
        <!-- End Header -->

        <!-- Sidebar -->
        <aside id="sidebar">
            <div class="sidebar-title">
                <div class="sidebar-brand">
                    <div class="material-icons-outlined"></div> TODO-LIST
                    <hr>
                </div>
                <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
            </div>

            <ul class="sidebar-list">
                <li class="sidebar-list-item">
                    <a href="#" target="_blank">
                        <span class="material-icons-outlined"></span> HOME
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="calendar.php" target="_blank">
                        <span class="material-icons-outlined"></span> CALENDAR
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="index2.php" target="_blank">
                        <span class="material-icons-outlined"></span> VIEW TASK
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="add_task.php" target="_blank">
                        <span class="material-icons-outlined"></span> NEW TASK
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="settings.php" target="_blank">
                        <span class="material-icons-outlined"></span> SETTINGS
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="index.html" target="_blank">
                        <span class="material-icons-outlined"></span> LOGOUT
                    </a>
                </li>
            </ul>
        </aside>
        <!-- End Sidebar -->

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
                <a href="index2.php" style="text-decoration:none" target="_blank">
                    <div class="card">
                        <div class="card-inner">
                            <p class="text-primary">View Task</p>
                            <span class="material-icons-outlined text-orange"></span>
                        </div>
                        <span class="text-primary font-weight-bold">0</span>
                    </div>
                </a>
                <a href="calendar.php" style="text-decoration:none" target="_blank">
                    <div class="card">
                        <div class="card-inner">
                            <p class="text-primary">Calendar</p>
                            <span class="material-icons-outlined text-green"></span>
                        </div>
                        <span class="text-primary font-weight-bold">0</span>
                    </div>
                </a>
            </div>
        </main>
    </div>
    <script>
        // Example: Function to update task counts dynamically
        function updateTaskCount(taskCount) {
            const taskCountElements = document.querySelectorAll('.card span.font-weight-bold');
            taskCountElements.forEach(element => {
                element.textContent = taskCount;
            });
        }

        // Call the function with a sample count
        updateTaskCount(1);

        // Sidebar toggle functions
        function openSidebar() {
            document.getElementById('sidebar').style.width = '250px';
        }

        function closeSidebar() {
            document.getElementById('sidebar').style.width = '0';
        }
    </script>
</body>

</html>
