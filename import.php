<?php
session_start();
$conn = mysqli_connect("localhost","root","","saint_anne");
if (!$conn) {
    echo "not connected";
}
if (!isset($_SESSION['userid'])) {
    header('location:./Auth/login.php');
}
?>
<a href="./Auth/logout.php">Logout</a>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
table,th,thead,tbody,td{
    border-collapse: collapse;
    border: 1px solid blue;
    padding: 30px;
}
</style>

<body>
    <h1>Products</h1>
    <a href="./addproduct.php">Add Product</a> <br> <br>
    <table>
        <thead>
            <tr>
                <th>no</th>
                <th>productID</th>
                <th>product name</th>
                <th>quantity</th>
                <th>Price per unity</th>
                <th>Total</th>
                <th>Date</th>
                <th>Action</th>


            </tr>
        </thead>
        <tbody>
<?php
$query = mysqli_query($conn,"SELECT * FROM stock_in INNER JOIN products ON stock_in.productID = products.productID");

 if (mysqli_num_rows($query) > 0) {
     $i = 1;
     while ($fetch =mysqli_fetch_assoc($query)) {
         $tbody = '
         <tr>
                 <td>'.$i++.'</td>
                 <td>'.$fetch['productID'].'</td>
                 <td>'.$fetch['productname'].'</td>
                 <td>'.$fetch['quantity'].'</td>
                 <td>'.$fetch['priceperunit'].'</td>
                 <td>'.$fetch['totalprice'].'</td>
              <td>'.$fetch['date'].'</td>
                 <td><a href="./update.php?id='.$fetch['productID'].'">Update</a>&nbsp;
                 <a href="./delete.php?id= '.$fetch['productID'].'">Delete</a>&nbsp;
                 <a href="./addexport.php?id= '.$fetch['productID'].'">Delete</a>&nbsp;</td>
                
                
   
             </tr>
        ';
        echo $tbody;
    }
}

?>
        </tbody>

    </table>
</body>

</html>