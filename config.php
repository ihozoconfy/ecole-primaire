<?php 

    session_start();

    $conn = mysqli_connect("localhost","root","","saint_anne");

    if(!$conn){
        echo "Not connected!";
    }

    if(!isset($_SESSION['UserId'])){
        header("Location:./login.php ");
    }

?>