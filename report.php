<?php 


include_once "./config.php";
$tbody = '';
$sql = mysqli_query($conn, "SELECT *, stock_in.Quantity AS p_in_q,
                                      stock_out.Quantity AS p_out_q,
                                      
                                      stock_in.Quantity AS p_in_tp,
                                      stock_out.Date AS p_out_date,
                                      stock_in.Date AS p_in_date
                                    FROM products
                                    INNER JOIN stock_in ON products.ProductId = stock_in.Product_Id
                                    INNER JOIN stock_out ON products.ProductId = stock_out.StockOutId
                                    " );


if($sql == true){
    $num_rows = mysqli_num_rows($sql);
    if($num_rows > 0){
        $a = 0;

        while($fetch = mysqli_fetch_assoc($sql)){
            $a++;
            $tbody .= '<tr>
                        <td></td>
                        <td>'.$fetch['ProductId'].'</td>
                        <td>'.$fetch['Product_Name'].'</td>
                        <td>'.$fetch['p_in_q'].'</td>
                        <td>'.$fetch['p_out_q'].'</td>
                        <td>'.$fetch['p_in_tp'].'</td>
                        
                        <td>'.$fetch['p_in_date'].'</td>
                        <td>'.$fetch['p_out_date'].'</td>
                    </tr>';
        }


    }else{
        $tbody = '<tr> <td> Not Record Found! </td> </tr>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <style>body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color:#fff;
}

header {
    background: rgb(73, 57, 113);
    color: #fff;
    padding: 10px 0;
    text-align: center;
}

h1 {
    text-align: center;
    margin-top: 20px;
}

button {
    margin: 10px auto;
    display: block;
    padding: 10px 20px;
    background-color: #4caf50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}

table {
    width: 90%;
    margin: 20px auto;
    border-collapse: collapse;
    background-color: white;
}

table th,
table td {
    padding: 10px;
    border: 1px solid #ccc;
}

table th {
    background-color: #f2f2f2;
}

table tbody tr:last-child td:first-child {
    text-align: right;
}

table tbody tr:last-child td {
    font-weight: bold;
}

@media print {
    button {
        display: none;
    }
}
</style>
</head>
<body>
<header><h1>STOCK REPORT</h1></header>
<button onclick="print()">PRINT</button>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Product ID</th>
                <th>Product name</th>
                <th>stock_in Quntity</th>
                <th>stock_out Quantity</th>
                <th>stock_in Total Price</th>
                
                <th>stock_in Date</th>
                <th>stock_out Date</th>
            </tr>
        </thead>
        <tbody>
            <?php echo $tbody; ?>
            <tr>
                <td>Total:</td>
                <td colspan="8"><?php echo $num_rows; ?></td>
            </tr>
        </tbody>
    </table>
    
</body>
</html>