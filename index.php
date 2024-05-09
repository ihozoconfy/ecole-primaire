<?php 

include "./config.php";

$sql = mysqli_query($conn, " SELECT * FROM products " );
$tbody = '';
if($sql ==  true){
    $num_rows = mysqli_num_rows($sql);

    if($num_rows > 0){
        $a = 0;
        while($fetch = mysqli_fetch_assoc($sql)){
            $a++;
            $tbody .= '<tr>
                            <td>'.$a.'</td>
                            <td>'.$fetch['ProductId'].'</td>
                            <td>'.$fetch['Product_Name'].'</td>
                            <td><a href="./p_update.php?id='.$fetch['ProductId'].'">Update</a></td>
                            <td><a href="./p_delete.php?id='.$fetch['ProductId'].'">Delete</a></td>
                            <td><a href="./i_add.php?id='.$fetch['ProductId'].'">Import</a></td>
                        </tr>';
        }
    }else{
        $tbody .= '<tr> <td> No Products </td> </tr>';
    }
}else{
    echo " Not selected ";
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Page</title>
    <style> body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}


header {
    background:#fff;
    color: #fff;
    padding: 10px 0;
    text-align: center;
}

h1 {
    margin-top: 20px;
    text-align: center;
    color: #fff;
}

.links {
    text-align: center;
    margin-bottom: 20px;
}

.links a {
    display: inline-block;
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

nav a {
    color: #fff;
    text-decoration: none;
    margin-right: 10px;
}

main {
    padding: 20px;
}

h1, h2 {
    margin-bottom: 10px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

table th, table td {
    padding: 8px;
    border: 1px solid #ccc;
}

table th {
   background-color: #333;
    text-align: left;
    color: #fff;
}

table td a {
    text-decoration: none;
    color: #fff;
}

table td a:hover {
    color: wheat;
}
a {
            display: inline-block;
            padding: 10px 20px;
            background-color: blue;
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
        <h1>ECOLE Saint_Anne</h1>
        <h2>STOCK</h2>
        <div class="links">
            <a href="./index.php">Home</a>
            <a href="./stockin.php">Stock In</a>
            <a href="./stockout.php">Stock In</a>
            <a href="./report.php">Generate Report</a>
            <a href="./logout.php">logout</a>
        </div>
    </header>

    <H1>Welcome</H1>

    <h2>Products</h2> <a href="./p_add.php">Add</a>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Product ID</th>
                <th>Product name</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php echo $tbody; ?>           
        </tbody>
    </table>
   
            
</body>
</html>