<?php 

include_once "./config.php";


if(isset($_POST['submit'])){
    $productid = $_POST['ProductId'];
    $productname = $_POST['Product_Name'];

    $sql = mysqli_query($conn, " INSERT INTO products(ProductId, Product_Name) VALUES('{$productid}','{$productname}') " );
    if($sql == true){
        echo "Record Added Successfully! <br/> <a href='./index.php'>Back To Home</a> ";
    }else{
        echo "Not INsterted";
    }


}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD PRODUCT</title>
    <style>body {
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
    background-color: #4caf50;
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

    <form action="" method="POST">
        <div>
            <label for="ProductId">product ID</label>
            <input type="number" name="ProductId" >
        </div>
        <div>
            <label for="Product_Name">Product name</label>
            <input type="text" name="Product_Name" >
        </div>
        <button type="submit" name="submit">Add</button>
    </form>

</body>
</html>