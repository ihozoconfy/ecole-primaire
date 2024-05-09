<?php 


include_once "./config.php";

if(!isset($_GET['id'])){
    header("Location: ./imports.php");
}

$id = $_GET['id'];
$sql = mysqli_query($conn, " SELECT * FROM stock_in INNER JOIN products ON stock_in.Product_Id = products.ProductId WHERE ProductId = '{$id}' " );
if($sql == true){
    $fetch = mysqli_fetch_assoc($sql);

    $form = '<form action="" method="POST">
                <div>
                    <label for="productid">Product id</label>
                    <input type="number" name="productid" value="'.$fetch['ProductId'].'" disabled>
                </div>
                <div>
                    <label for="pass">Product name</label>
                    <input type="text" name="productname" value="'.$fetch['Product_Name'].'" disabled>
                </div>
                <div>
                    <label for="pass">Quantity</label>
                    <input type="text" name="quantity" value="'.$fetch['Quantity'].'">
                </div>
                <div>
                    <label for="pass">Price Per Unit</label>
                    <input type="text" name="price_per_unit" value="'.$fetch['Unit_Price'].'" >
                </div>
                
                <div>
                    <label for="pass">Date</label>
                    <input type="date" name="date" value="'.$fetch['Date'].'" >
                </div>
                <button type="submit" name="submit">Update</button>
            </form>';
}


if(isset($_POST['submit'])){
    $quantity = $_POST['quantity'];
    $price_per_unit = $_POST['price_per_unit'];
    $date = $_POST['date'];
    $total_price = $price_per_unit * $quantity;

    $sql = mysqli_query($conn, " UPDATE stock_in SET Quantity = '{$quantity}', Unit_Price = '{$price_per_unit}', `Date` = '{$date}', Total_Price = '{$total_price}' WHERE Product_Id = '{$id}'  " );
    if($sql == true){
        echo "Updated success! <br/> <a href='./imports.php'>View Imports</a> ";
    }else{
        echo "NOt updated!";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPDATE PRODUCT</title>
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
form input[type="date"],
form button[type="submit"] {
    width: calc(100% - 10px);
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

form input[type="text"]:disabled,
form input[type="number"]:disabled,
form input[type="date"]:disabled {
    background-color: #f2f2f2;
    cursor: not-allowed;
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


    <h1>Update Product</h1>
    <?php echo $form; ?>

</body>
</html>