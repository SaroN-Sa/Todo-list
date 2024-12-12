<?php
session_start();
if(isset($_POST['save']))
{
    extract($_POST);
    include 'dbcon.php';
    $hashed_password = md5($pass);
    $stmt = $con->prepare("SELECT * FROM register WHERE Email=? AND Password=?");
    $stmt->bind_param("ss", $email, $hashed_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        $_SESSION["ID"] = $row['ID'];
        $_SESSION["Email"] = $row['Email'];
        header("Location:passdash.php");
        exit();
    }
    else
    {
        echo "Invalid Email ID/Password";
    }
}
?>
