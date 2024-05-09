<?php
session_start();
$conn = mysqli_connect("localhost","root","","saint_anne");
if (!$conn) {
    echo "not connected";
}
if (!isset($_SESSION['userid'])) {
    header('location:./login.php');
}
if ($_GET['id']) {
    $pid = $_GET['id']; 
    $sql = "DELETE FROM `products` WHERE `productid`=$pid";
    $result = mysqli_query($conn,$sql);
    if ($result === TRUE) {
        header("location: ./index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>