<?php 

    include_once "./config.php";

    if(!isset($_GET['id'])){
        header("Location: ./exports.php");
    }
    
    $id = $_GET['id'];

    $sql = mysqli_query($conn, " DELETE FROM stock_out WHERE StockOutId = '{$id}' " );
    if($sql == true){
        header("Location: ./exports.php");
    }else{
        echo "Not Deleted!";
    }
