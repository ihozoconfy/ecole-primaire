<?php 


include "./config.php";

$sql = mysqli_query($conn,  " SELECT * FROM stock_out INNER JOIN products ON stock_out.StockOutId = products.ProductId " );
$tbody = '';
if($sql == true){
    $a= 0;
    $num_rows = mysqli_num_rows($sql);
    if($num_rows > 0){
        while($fetch = mysqli_fetch_assoc($sql)){
            $a++;
            $tbody .= '<tr>
                            <td>'.$a.'</td>
                            <td>'.$fetch['ProductId'].'</td>
                            <td>'.$fetch['Product_Name'].'</td>
                           
                            <td>'.$fetch['Quantity'].'</td>
                         
                            <td>'.$fetch['Date'].'</td>
                            <td><a href="./e_update.php?id='.$fetch['StockOutId'].'">Update</a></td>
                            <td><a href="./e_delete.php?id='.$fetch['StockOutId'].'">Delete</a></td>
                        </tr>';
        }
    }else{
        $tbody .= '<tr> <td colspan="8"> No Exports Found! </td> </tr>';
    }
}else{
    echo "Not Selected";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>stock out</title>
    <style>
    
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #fff;
}

header {
    background: rgb(73, 57, 113);
    color: #fff;
    padding: 10px 0;
    text-align: center;
}

h1 {
    margin-top: 20px;
    text-align: center;
}

.links {
    text-align: center;
    margin-bottom: 20px;
}

.links a {
    display: inline-block;
    padding: 10px 20px;
    margin: 0 10px;
    color: #333;
    text-decoration: none;
    background-color: #fff;
    border: 1px solid #333;
    border-radius: 5px;
    transition: background-color 0.3s, color 0.3s;
}

.links a:hover {
    background-color: #333;
    color: #fff;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table th,
table td {
    padding: 10px;
    text-align: center;
}

table th {
    background-color: #333;
    color: #fff;
}

table td {
    background-color: #fff;
}

table tr:nth-child(even) td {
    background-color: #f2f2f2;
}

table tr:hover td {
    background-color: #ddd;
}

table td:last-child {
    text-align: center;
}

table a {
    text-decoration: none;
    color: #fff;
}

table a:hover {
    color: #f00;
}

a {
            display: inline-block;
            padding: 10px 20px;
            background: rgb(73, 57, 113);
            color: #fff; /* White text */
            text-decoration: none; /* Remove underline */
            border-radius: 5px; /* Rounded corners */
            transition: background-color 0.3s; /* Smooth transition */
        }

        /* Hover effect */
        a:hover {
            background-color: #0056b3; /* Darker blue */
        }

</style>
</head>
<body> 


    <header>
        <h1>Stocked Out Products</h1>
        <div class="links">
            <a href="./index.php">Home</a>
            <a href="./imports.php">Stock In</a>
            <a href="./exports.php">Stock Out</a>
            <a href="./Auth/logout.php">logout</a>
        </div>
    </header>

    <H1>Welcome</H1>

    <h2>Products </h2><a href="./index.php">View Products</a>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Product_Id</th>
                <th>Product Name</th>
                
                <th>Quantity</th>
               
                <th>Date</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php echo $tbody; ?>           
        </tbody>
    </table>


</body>
</html>