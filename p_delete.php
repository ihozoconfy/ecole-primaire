<?php 

include_once "./config.php";

if(!isset($_GET['id'])){
    header("Location: ./index.php");
}
$id = $_GET['id'];

$sql = mysqli_query($conn, " DELETE FROM stock_in WHERE Product_Id = '{$id}' " );
if($sql == true){
    $sql = mysqli_query($conn, "DELETE FROM products WHERE ProductId = '{$id}' " );
    if($sql == true){
        header("Location: ./index.php");
    }
}


?>