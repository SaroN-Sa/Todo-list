

<?php

$servername = "localhost"; // or your server name
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "ephy"; // your database name

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>



