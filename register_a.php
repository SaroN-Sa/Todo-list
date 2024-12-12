<?php
extract($_POST);
include("dbcon.php");

$sql = mysqli_query($con, "SELECT * FROM register where Email='$email'");
if (mysqli_num_rows($sql) > 0) {
    echo "Email Id Already Exists";
    exit;
} else {
    $query = "INSERT INTO register(First_Name, Last_Name, Email, Password) VALUES ('$first_name', '$last_name', '$email', '" . md5($pass) . "')";
    $sql = mysqli_query($con, $query) or die("Could Not Perform the Query");
    header("Location: index1.php?status=success");
}
?>
