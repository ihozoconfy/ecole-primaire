<?php
session_start();
$conn = mysqli_connect("localhost","root","","saint_anne");
if (!$conn) {
    echo "not connected";
}
if (!isset($_SESSION['userid'])) {
    header('location:./login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f2f2f2;
}

form {
    width: 300px;
    margin: 50px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #fff;
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="number"],
input[type="text"],
button[type="submit"] {
    width: calc(100% - 20px);
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

button[type="submit"] {
    background-color: #4caf50;
    color: white;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #45a049;
}

footer {
    background: rgb(54, 77, 77);
    color: white;
    text-align: center;
    padding: 20px 0;
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
}
</style>
</head>
<body>

    <form action="" method="POST">
    <h1>Add New Product</h1>
            <label for="Product Name">PRODUCT ID</label><br>
            <input type="number" name="productid"><br><br>
            <label for="Product Name">PRODUCT NAME</label><br>
            <input type="text" name="productname"> <br><br>
        <button type="submit" name="addnewinfo">Add New Product</button> 
    </form>
        <?php
if (isset($_POST['addnewinfo'])) {
    $productid = $_POST['productid'];
    $productname = $_POST['productname'];
   
   
        $add =  mysqli_query($conn,"INSERT INTO products(productID,product_Name) VALUES('{$productname}','{$productid}')");
        if ($add) {
            header("location: ./index.php");
        } }

?>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>stock in</title>
</head>
<style>
footer{
    background: rgb(54, 77, 77);
    color: white;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    font-size: large;
    position: absolute;
    top: 900px;
    left: 0px;
    width: 100%;
}
</style>
<body>
    <footer>

        <p>&copy; Copyright Rwanda driving license . all rights reserved</p> 
        <p>Done By Ganza David in 2024</p>
    </footer>
</body>
</html>