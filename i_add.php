<?php 

include_once "./config.php";

if(!isset($_GET['id'])){
    header("Location: ./index.php");
}
$id = $_GET['id'];

$sql = mysqli_query($conn, " SELECT * FROM products WHERE productID = '{$id}' " );

if($sql == true){
    $fetch = mysqli_fetch_assoc($sql);
    
    $form = '<form action="" method="POST">
                <div>
                    <label for="productid">Product id</label>
                    <input type="number" name="productid" value="'.$fetch['ProductId'].'" disabled>
                </div>
                <div>
                    <label for="productname">Product name</label>
                    <input type="text" name="productname" value="'.$fetch['Product_Name'].'" disabled>
                </div>
                <div>
                    <label for="pass">Quantity</label>
                    <input type="text" name="quantity">
                </div>
                <div>
                    <label for="pass">Price Per Unit</label>
                    <input type="text" name="price_per_unit">
                </div>
                
                <div>
                    <label for="pass">Date</label>
                    <input type="date" name="date">
                </div>
                <button type="submit" name="submit">stock_in</button>
            </form>';

}

if(isset($_POST['submit'])){
    $price_per_unit = $_POST['price_per_unit'];
    $quantity = $_POST['quantity'];
    $date = $_POST['date'];
    $total_price = $quantity * $price_per_unit;

    $check = mysqli_query($conn, " SELECT * FROM stock_in WHERE product_Id = '{$id}' " );
    if(mysqli_num_rows($check) > 0){
        $fetch = mysqli_fetch_assoc($check);
        $new_quantity = $fetch['Quantity'] + $quantity;
        $new_total_price = $fetch['Total_Price'] + $total_price;

        $query = mysqli_query($conn, " UPDATE stock_in SET quantity= '{$new_quantity}', total_price = '{$new_total_price}',Unit_Price = '{$price_per_unit}', `date` = '{$date}'  WHERE product_id = '{$id}'  " );
        if($query == true){
            echo "Record Updated! <br/> <a href='./imports.php'>View Imports</a>";
        }else{
            echo "not updated!";
        }
    }else{
        $sql = mysqli_query($conn, " INSERT INTO stock_in(product_Id, `Date`, quantity, Unit_Price, Total_price) 
                                    VALUES('{$id}','{$date}','{$quantity}','{$price_per_unit}','{$total_price}' ) " );
        if($sql == true){
            echo "Record Added Successfully! <br/> <a href='./imports.php'>View Imports</a> ";
        }else{
            echo "Not Inserted!";
        }

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
form input[type="date"],
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


    <h1>Stock In Product</h1>
    <?php echo $form; ?>

</body>
</html>