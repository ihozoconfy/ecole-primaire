<?php 

    include_once "./config.php";

    if(!isset($_GET['id'])){
        header("Location: ./imports.php");
    }

    $sql = mysqli_query($conn, " DELETE FROM stock_in WHERE Product_Id = '{$id}' " );
    if($sql == true){
        header("Location: ./imports.php");
    }else{
        echo "Not Deleted!";
    }

?>
