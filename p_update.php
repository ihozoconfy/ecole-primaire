<?php 

include_once "./config.php";

$id = $_GET['id'];

$sql = mysqli_query($conn, " SELECT * FROM products WHERE ProductId = '{$id}' " );

if($sql == true){
    $fetch = mysqli_fetch_assoc($sql);
    $form = '<form action="" method="POST">
                    <div>
                        <label for="productid">Product id</label>
                        <input type="number" name="productid" value="'.$fetch['ProductId'].'" >
                    </div>
                    <div>
                        <label for="pass">Product name</label>
                        <input type="text" name="productname" value="'.$fetch['Product_Name'].'" >
                    </div>
                    <button type="submit" name="submit">Update</button>
                </form>';

}else{
    echo "Not selected!";
}

if(isset($_POST['submit'])){
    $productid = $_POST['productid'];
    $productname = $_POST['productname'];

    $sql = mysqli_query($conn, " UPDATE products SET ProductId  = '{$productid}', Product_Name = '{$productname}' WHERE ProductId  = '{$id}' " );
    if($sql == true){
        echo "Record updated! <br/> <a href='./index.php'> Back to home </a> ";
    }else{
        echo "Not updated!";
    }

}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPDATE PRODUCT</title>
    <style> body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f2f2f2;
}

h1 {
    text-align: center;
    margin-top: 20px;
}

form {
    width: 300px;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #fff;
}

form div {
    margin-bottom: 15px;
}

form label {
    display: block;
    margin-bottom: 5px;
}

form input[type="text"],
form input[type="number"],
form button[type="submit"] {
    width: calc(100% - 10px);
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

form button[type="submit"] {
    width: 100%;
    background: rgb(73, 57, 113);
    color: white;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

form button[type="submit"]:hover {
    background-color: #45a049;
}

form div:last-child {
    margin-bottom: 0;
    text-align: center;
}
</style>
</head>
<body>

    <?php echo $form; ?>

</body>
</html>