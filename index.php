

<?php

$title = "Welcome to ACME web shop";
include ("./includes/header.php");

?>

<div class="phones-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1 class="display-4">The best electronic devices</h1>
  <p class="lead">We offer a small range of exclusive electronic devices, hand-picked by us. We offer the best quality
  and the best price, all you need for safe shopping. The only webshop you'll need! </p>
</div>

<?php
// get the data from the database
// first create the query
$query_products = "SELECT * FROM products";
// and then execute it
$sql_products = mysqli_query($connection, $query_products);

echo '<div class="row">' . "\n";

// an array results after each iteration
while($products = mysqli_fetch_assoc($sql_products)){

  // echo "<pre>";
  // print_r($products);
  // echo "</pre>";

  // The array returned with mysqli_fetch_assoc ($products) is encoded as a string
  // in order to pass all the elements to the order.php page (via GET) in a safe and secure way
  // (only one parameter instead of all the array's elements, such as 'image', 'name', 'description', 'price').
  // For example avoid the problems caused by non-html compliant characters (spaces, tabs, diacritics) in the URL
  // http://php.net/manual/en/function.serialize.php
  // http://php.net/manual/en/function.base64-encode.php
  $parameter = base64_encode(serialize($products));
  echo '<div class="col-sm-4"><!-- Start a column -->' . "\n";
  echo '  <div class="card">' . "\n";
  echo '    <img class="card-img-top" src="./images/' . $products["image"] . '" alt="' . $products["name"] . '">' . "\n";
  echo '    <div class="card-body">' . "\n";
  echo '      <h3 class="card-title">' . $products["name"] . '</h3>' . "\n";
  echo '      <h5 class="card-title pricing-card-title">' . $products["price"] . '<small class="text-muted"> kr</small></h5>' . "\n";
  echo '      <p class="card-text">' . $products["description"] . '</p>' . "\n";
  echo '      <a href="order.php?parameter=' . $parameter . '" class="btn btn-primary">Order</a>' . "\n";
  echo '    </div>' . "\n";
  echo '  </div>' . "\n";
  echo '</div><!-- end a column -->' . "\n";

} // end while

echo '</div> <!-- row -->' . "\n";

include ("./includes/footer.php");
?>
