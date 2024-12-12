<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List Calendar</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('mus.jpg'); /* Replace with your background image */
            background-size: cover;
            background-position: center;
            color: #333;
            margin: 0;
            padding: 0;
            position: relative;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent background for readability */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 900px;
            margin: 20px auto;
            position: relative;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f0f0f0;
        }
        .today {
            background-color: #ffeb3b;
        }
        .day {
            position: relative;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .day:hover {
            background-color: #e9ecef;
        }
        .day:hover .tooltip {
            display: block;
        }
        .tooltip {
            display: none;
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background-color: #333;
            color: #fff;
            padding: 5px;
            border-radius: 3px;
            font-size: 12px;
            white-space: nowrap;
        }
        .nav-buttons {
            margin-bottom: 20px;
            text-align: center;
        }
        .nav-buttons a {
            display: inline-block;
            padding: 10px 20px;
            margin: 0 10px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .nav-buttons a:hover {
            background-color: #0056b3;
        }
        .month-year-select {
            margin-bottom: 20px;
            text-align: center;
        }
        .add-task {
            margin-top: 20px;
            text-align: center;
        }
        .add-task form input {
            margin: 5px;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .add-task button {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            background-color: #dc3545;
            color: white;
            cursor: pointer;
        }
        .add-task button:hover {
            background-color: #c82333;
        }
        .watermark {
            position: absolute;
            bottom: 10px;
            right: 10px;
            font-size: 50px;
            color: blue;
            font-family: 'Arial', sans-serif;
            pointer-events: none;
            z-index: 1000;
        }
        /* Back Button Styles */
        .back-button {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
            font-size: 16px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            display: flex;
            align-items: center;
        }
        .back-button:before {
            content: '←';
            font-size: 20px;
            margin-right: 5px;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <button class="back-button" onclick="window.location.href='passdash.php';">Back</button>
        <h1>To-Do List Calendar</h1>

        <?php
        // Get month and year from URL parameters or default to current month and year
        $month = isset($_GET['month']) ? intval($_GET['month']) : date('m');
        $year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');

        // Navigation for month and year
        $months = array(
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June',
            7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
        );

        echo '<div class="month-year-select">';
        echo '<form method="get" action="">';
        echo '<select name="month">';
        foreach ($months as $num => $name) {
            $selected = ($num == $month) ? 'selected' : '';
            echo "<option value='$num' $selected>$name</option>";
        }
        echo '</select>';
        echo '<select name="year">';
        for ($i = date('Y') - 10; $i <= date('Y') + 10; $i++) {
            $selected = ($i == $year) ? 'selected' : '';
            echo "<option value='$i' $selected>$i</option>";
        }
        echo '</select>';
        echo '</form>';
        echo '</div>';

        // Navigation for previous and next month
        $prev_month = $month - 1;
        $prev_year = $year;
        if ($prev_month == 0) {
            $prev_month = 12;
            $prev_year--;
        }

        $next_month = $month + 1;
        $next_year = $year;
        if ($next_month == 13) {
            $next_month = 1;
            $next_year++;
        }

        echo '<div class="nav-buttons">';
        echo '<a href="?month=' . $prev_month . '&year=' . $prev_year . '">Previous</a> | ';
        echo '<a href="?month=' . $next_month . '&year=' . $next_year . '">Next</a>';
        echo '</div>';

        // Get the first day of the month
        $first_day = mktime(0, 0, 0, $month, 1, $year);
        $days_in_month = date('t', $first_day);
        $day_of_week = date('w', $first_day);

        // Display the calendar
        echo '<table>';
        echo '<tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>';
        echo '<tr>';

        // Print empty cells for days before the first of the month
        if ($day_of_week > 0) {
            for ($i = 0; $i < $day_of_week; $i++) {
                echo '<td></td>';
            }
        }

        // Print the days of the month
        for ($day = 1; $day <= $days_in_month; $day++) {
            if (($day_of_week + $day - 1) % 7 == 0 && $day > 1) {
                echo '</tr><tr>';
            }

            // Highlight today
            $class = ($day == date('j') && $month == date('m') && $year == date('Y')) ? 'today' : 'day';

            echo "<td class='$class' onclick='showTaskForm($day)'>$day";
            echo "<div class='tooltip'>Click to add a task</div></td>";
        }

        // Print empty cells for the remaining days of the week
        for ($i = ($day_of_week + $days_in_month) % 7; $i < 7 && $i > 0; $i++) {
            echo '<td></td>';
        }

        echo '</tr>';
        echo '</table>';
        ?>

        <!-- Add Task Form -->
        <div class="add-task" id="taskForm" style="display: none;">
            <h2>Add Task</h2>
            <form action="add_task.php" method="post">
                <input type="hidden" id="selectedDate" name="task_date">
                <input type="hidden" name="task_name" placeholder="Task Name" required>
                <input type="submit" value="Add Task">
            </form>
            <button onclick="closeTaskForm()">Cancel</button>
        </div>

        <script type="text/javascript">
            function showTaskForm(day) {
                var date = new Date();
                var month = date.getMonth() + 1;
                var year = date.getFullYear();
                var selectedDate = year + '-' + (month < 10 ? '0' + month : month) + '-' + (day < 10 ? '0' + day : day);
                
                document.getElementById('selectedDate').value = selectedDate;
                document.getElementById('taskForm').style.display = 'block';
            }

            function closeTaskForm() {
                document.getElementById('taskForm').style.display = 'none';
            }
        </script>
    </div>

    <!-- Watermark -->
    <div class="watermark"></div>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            updateWatermark();

            // Update watermark when form inputs change
            document.querySelector('.month-year-select form').addEventListener('change', function() {
                updateWatermark();
            });
        });

        function updateWatermark() {
            var monthSelect = document.querySelector('select[name="month"]');
            var yearSelect = document.querySelector('select[name="year"]');
            var watermark = document.querySelector('.watermark');

            var monthIndex = parseInt(monthSelect.value, 10);
            var year = parseInt(yearSelect.value, 10);

            var months = [
                'January', 'February', 'March', 'April', 'May', 'June',
                'July', 'August', 'September', 'October', 'November', 'December'
            ];

            var monthName = months[monthIndex - 1];

            watermark.textContent = monthName + ' ' + year;
        }
    </script>
</body>
</html>
