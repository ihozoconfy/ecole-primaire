<?php 


include_once "./Auth/config.php";

if(!isset($_GET['id'])){
    header("Location: ./import.php");
}

$id = $_GET['id'];
$sql = mysqli_query($conn, " SELECT * FROM stock_out INNER JOIN products ON stock_out.productID = products.productID WHERE id = '{$id}' " );
if($sql == true){
    $fetch = mysqli_fetch_assoc($sql);

    $form = '<form action="" method="POST">
                <div>
                    <label for="pass">Product ID</label>
                    <input type="number" name="productid" value="'.$fetch['productid'].'" disabled>
                </div>
                <div>
                    <label for="pass">Product name</label>
                    <input type="text" name="productname" value="'.$fetch['productname'].'" disabled>
                </div>
                <div>
                    <label for="pass">Quantity</label>
                    <input type="text" name="quantity" value="'.$fetch['quantity'].'">
                </div>
                <div>
                    <label for="pass">Price Per Unit</label>
                    <input type="text" name="price_per_unit" value="'.$fetch['price_per_unit'].'" >
                </div>
                
                <div>
                    <label for="pass">Date</label>
                    <input type="date" name="date" value="'.$fetch['date'].'" >
                </div>
                <button type="submit" name="submit">Update</button>
            </form>';
}


if(isset($_POST['submit'])){
    $quantity = $_POST['quantity'];
    $price_per_unit = $_POST['price_per_unit'];
    $date = $_POST['date'];
    $total_price = $price_per_unit * $quantity;

    $sql = mysqli_query($conn, " UPDATE stock_out SET quantity = '{$quantity}', price_per_unit = '{$price_per_unit}', `date` = '{$date}', total_price = '{$total_price}' WHERE id = '{$id}'  " );
    if($sql == true){
        echo "Updated success! <br/> <a href='./exports.php'>View Imports</a> ";
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
</head>
<body>


    <h1>Update Product</h1>
    <?php echo $form; ?>

</body>
</html>