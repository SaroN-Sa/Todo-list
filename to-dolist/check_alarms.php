<?php
require 'dbcon.php';

// Get the current time
$current_time = date('Y-m-d H:i:s');

// Fetch alarms that need to be triggered
$query = "SELECT a.id, t.task, a.alarm_time 
          FROM alarms a 
          JOIN tasks t ON a.task_id = t.id 
          WHERE a.alarm_time <= ? AND a.notified = 0";
$stmt = $con->prepare($query);
$stmt->bind_param("s", $current_time);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    // Notify user (e.g., using a file to log notifications or send an email)
    file_put_contents('notification_log.txt', "Alarm for task '{$row['task']}' is due at {$row['alarm_time']}.\n", FILE_APPEND);

    // Mark the alarm as notified
    $updateStmt = $con->prepare("UPDATE alarms SET notified = 1 WHERE id = ?");
    $updateStmt->bind_param("i", $row['id']);
    $updateStmt->execute();
}

$con->close();
?>
