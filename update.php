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
       
if (isset($_POST['update'])) {
   $productid = $_POST['productid'];
   $productname = $_POST['productname'];
   $sql = "UPDATE products SET `productid` = '{$productid}',`productname`= '{$productname}' WHERE `productid`= {$pid}";
   $query = mysqli_query($conn,$sql);
       if ($query) {
           header('location:./index.php');
       }
    else{
        echo "data is not updated";
    } }
}
?>
<?php
   $select = mysqli_query($conn,"SELECT * FROM products WHERE productid=$pid");
   if ($select) {
       $fetch = mysqli_fetch_assoc($select);  
   }
echo '<form action="" method="POST">
   <h1>Update Product</h1>
           <label for="Product Name">Product id</label><br>
           <input type="text" name="productid" value="'.$fetch['productid'].'"><br><br>
           <label for="Product Name">Product name</label><br>
           <input type="text" name="productname" value="'.$fetch['productname'].'"> <br><br>
       <button type="submit" name="update">Update</button> 
   </form>';
?>