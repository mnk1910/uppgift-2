<?php

// Create an own service server (own RESTful API)

// Step 1: Log into the database 'acme_webshop'
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "root";
$dbName = "acme_webshop";
$connection = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
if(!$connection){
    echo "Error message<br>" . mysqli_connect_error();
    exit;
}
// echo "Logging into 'acme_webshop' database was successful!";

// Step 2: Pull data from the database
// Create an SQL-query
$query = "SELECT * FROM products";
// Execute the SQL-query
$products = mysqli_query($connection, $query) 
               or die(mysqli_error($connection));
// echo $products;

// Step 3: Load the data into an array
// Create an array
$array = array(); // or []
// Every post in the table 'producs' will be an associative array
// while($row = $products->fetch_assoc()) {
while($row = mysqli_fetch_assoc($products)) {
    // Add
    $array[] = $row;
}
// Test
// print ("<pre>");
// print_r($array);
// print ("</pre>");
// die;

// Step 4: Create JSON with help of the functionen json_encode()
// Tip: http://php.net/manual/en/function.json-encode.php
$json_products = json_encode($array, JSON_PRETTY_PRINT);
// Write the created JSON
echo $json_products;
// OBS! We don't need to add anything more (any other info)!

// http://localhost/UPPGIFT-2/api/
// http://localhost/UPPGIFT-2/api/products/

?>