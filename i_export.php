<?php 

include_once "./config.php";


if(!isset($_GET['id'])){
    header("Location: ./imports.php");
}

$id = $_GET['id'];
$sql = mysqli_query($conn, " SELECT * FROM stock_in INNER JOIN products ON stock_in.Product_Id = products.ProductId WHERE stock_in.Product_Id = '{$id}'" );

if($sql == true){
    $fetch = mysqli_fetch_assoc($sql);

    $form = '<form action="" method="POST">
    <div>
        <label for="productId">Product id</label>
        <input type="text" name="productId" value="'.$fetch['ProductId'].'" disabled>
    </div>
    <div>
        <label for="pass">Product name</label>
        <input type="text" name="Productname" value="'.$fetch['Product_Name'].'" disabled>
    </div>
    <div>
        <label for="pass">Quantity</label>
        <input type="text" name="Quantity" value="'.$fetch['Quantity'].'" >
    </div>
    <div>
        <label for="pass">Price Per Unit</label>
        <input type="number" name="Unit_Price" value="'.$fetch['Unit_Price'].'" >
    </div>
    
    <div>
        <label for="pass">Date</label>
        <input type="Date" name="Date" value="'.$fetch['Date'].'" >
    </div>
    <button type="submit" name="submit">Export</button>
</form>';



if(isset($_POST['submit'])){
    $Quantity = $_POST['Quantity'];
    $Unit_Price = $_POST['Unit_Price'];
    $Date = $_POST['Date'];
    $total_price = $Quantity * $Unit_Price;

    $check = mysqli_query($conn, " SELECT * FROM stock_out WHERE product_Id = '{$id}' " );
    if(mysqli_num_rows($check) > 0){
        $fetch = mysqli_fetch_assoc($check);
        $new_quantity = $fetch['quantity'] + $quantity;
        $new_total_price = $fetch['total_price'] + $total_price;

        $sql = mysqli_query($conn, " UPDATE stock_out SET total_price = '{$new_total_price}', quantity='{$new_quantity}', `date` = '{$date}', price_per_unit = '{$price_per_unit}' WHERE productID = '{$id}' " );
        if($sql == true){
            $sql = mysqli_query($conn, "SELECT * FROM stock_in WHERE Product_Id = '{$id}' ");
            $fetch = mysqli_fetch_assoc($sql);

            $new_imp_quantity = $fetch['quantity'] - $quantity;
            $new_imp_total_price = $fetch['total_price'] - $total_price;

            $sql = mysqli_query($conn, " UPDATE stock_in SET Total_Price = '{$new_imp_total_price}', Quantity='{$new_imp_quantity}', `Date` = '{$date}', Unit_Price = '{$price_per_unit}' WHERE Product_Id = '{$id}' " );
            if($sql == true){
                echo "Record Exported! <a href='./exports.php'>View Exports</a> ";
            }
        }
    }else{

$checkQuery = mysqli_query($conn, "SELECT * FROM stock_out WHERE StockOutId = '{$id}'");

if(mysqli_num_rows($checkQuery) > 0) {
    echo "Record with StockOutId '{$id}' already exists.";
} else {
   
    $sql = mysqli_query($conn, "INSERT INTO stock_out (StockOutId, `Date`, Quantity) VALUES ('{$id}', '{$Date}', '{$Quantity}')");

    if($sql) {
        echo "Record inserted successfully.";
    } else {
        echo "Failed to insert record.";
    }
}


        if($sql == true){
            $sql = mysqli_query($conn, "SELECT * FROM stock_in WHERE Product_Id = '{$id}' ");
            $fetch = mysqli_fetch_assoc($sql);

            $new_imp_quantity = $fetch['Quantity'] - $Quantity;
            $new_imp_total_price = $fetch['Total_Price'] - $total_price;

            $sql = mysqli_query($conn, " UPDATE stock_in SET Total_Price = '{$new_imp_total_price}', Quantity='{$new_imp_quantity}', `Date` = '{$Date}', Unit_Price = '{$Unit_Price}' WHERE Product_Id = '{$id}' " );
            if($sql == true){
                echo "Record Exported! <a href='./exports.php'>View Exports</a> ";
            }
        }

    }

}



}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Out</title>
    <style>body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f2f2f2;
}

form {
    max-width: 500px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

form div {
    margin-bottom: 10px;
}

form label {
    display: block;
    font-weight: bold;
}

form input[type="text"],
form input[type="number"],
form input[type="date"] {
    width: calc(100% - 20px);
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

form button[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: #333;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

form button[type="submit"]:hover {
    background-color: #555;
}
</style>
</head>
<body>

    <?php echo $form; ?>
    
</body>
</html>