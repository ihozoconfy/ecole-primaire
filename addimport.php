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
$select = mysqli_query($conn,"SELECT * FROM products WHERE productid=$pid");
if ($select) {
    $fetch = mysqli_fetch_assoc($select);  
}}
echo '<form action="" method="POST">
   <h1>stock_in your product</h1>
           <label for="Product Name">Product ID</label><br>
           <input type="number" name="productid" value="'.$fetch['productid'].'" readonly><br><br>
           <label for="Product Name">Product name</label><br>
           <input type="text" name="productname" value="'.$fetch['productname'].'" readonly> <br><br>
           <label for="priceperunit">Price per unit</label><br>
           <input type="number" name="priceperunit"> <br><br>
           <label for="priceperunit">Quantity</label><br>
           <input type="number" name="quantity"> <br><br>
           <label for="date">Date</label><br>
           <input type="date" name="date"> <br><br>
       <button type="submit" name="stockin">stock_in</button> 
   </form>';
?>
        <?php
if (isset($_POST['stockin'])) {
    $priceperunit = $_POST['priceperunit'];
    $quantity = $_POST['quantity'];
    $date = $_POST['date'];
    $totalprice = $priceperunit * $quantity;  
    $sql = "SELECT * FROM stock_in where productid=$pid";
    $query = mysqli_query($conn,$sql);
    $fetch = mysqli_fetch_assoc($query);
    if (mysqli_num_rows($query) > 0) {
        $newquantity = $fetch['quantity'] + $quantity;
        $newpriceperunit = $_POST['priceperunit'];
        $initialtotalprice = $newquantity * $newpriceperunit;
        $newtotalprice = $initialtotalprice + $fetch['totalprice'];
        $newdate = $_POST['date'];
        $update = mysqli_query($conn,"UPDATE stock_in SET priceperunit=$newpriceperunit,quantity=$newquantity,totalprice=$newtotalprice,date=$newdate WHERE productid=$pid");
        if ($update) {
            echo "Record is updated but not inserted";
            echo '<a href="./import.php">Import</a>';
            
        }
    }
    else{
    $add =  mysqli_query($conn,"INSERT INTO stock_in(id,priceperunit,quantity,totalprice,`date`,productid) VALUES('','$priceperunit','$quantity','$totalprice','$date','$pid')");
    if ($add) {
        header("location:./stock_in.php");
    }
}

        }

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
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

form {
    width: 300px;
    margin: 50px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
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
input[type="date"],
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
<body>
    <footer>

        <p>&copy; Copyright Rwanda driving license . all rights reserved</p> 
        <p>Done By ganza david in 2024</p>
    </footer>
</body>
</html>