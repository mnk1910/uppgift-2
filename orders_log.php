<?php

$title = "Orders log";
include ("./includes/header.php");

// Databasuppkoppling
// Already done in header.php

//Skapa en SQL-sats
$query = "SELECT o.*, p.name AS product_name, p.price AS product_price
FROM  order_log AS o, products AS p
WHERE o.product_id = p.product_id
ORDER BY o.order_id";
// AND   f.filmID = u.Film
// AND   u.inDatum IS NULL
// ORDER BY u.utDatum";

// Kör SQL-satsen
$table = mysqli_query($connection , $query)
          or die (mysqli_error($connection));

// Visa en HTML-tabell
?>

<div>Customer data and orders history</div>

<table class="table">
<tr>
    <th colspan="8" style="text-align: center;">Customer orders</th>
</tr>
<tr> 
    <th>Order number</th> 
    <th>Product ID</th>
    <th>Customer name</th> 
    <th>Customer email</th> 
    <th>Customer Phone number</th>
    <th>Customer address</th>
    <th>Product name</th>
    <th>Product price</th>
<?php while($row = mysqli_fetch_assoc($table)) { 
    // echo "<pre>";
    // print_r($row);
    // echo "</pre>";
    ?>

<tr>
    <td><?php echo $row['order_id'] ?></td>
    <td><?php echo $row['product_id'] ?></td>
    <td><?php echo $row['customer_name'] ?></td>
    <td><?php echo $row['customer_mail'] ?></td>
    <td><?php echo $row['customer_phone'] ?></td>
    <td><?php echo $row['customer_address'] ?></td>
    <td><?php echo $row['product_name'] ?></td>
    <td><?php echo $row['product_price'] ?></td>
</tr>
<?php 

} ?>

</table>

<?php
mysqli_close($connection);
?>