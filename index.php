<?php

$title = "Welcome to ACME web shop";
include ("./includes/header.php");

?>

<div class="phones-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1 class="display-4">Electronics</h1>
  <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sed turpis tincidunt id aliquet risus. A condimentum vitae sapien pellentesque habitant morbi. Volutpat lacus laoreet non curabitur gravida arcu ac tortor dignissim. Nibh venenatis cras sed felis.</p>
</div>

<?php
// get the data from the database
// first create the query
$query_products = "SELECT * FROM products";
// and then execute it
$sql_products = mysqli_query($connection, $query_products);

echo '<div class="row">' . "\n";

// ia un array la fiecare iteratie
while($result_products = mysqli_fetch_assoc($sql_products)){

  // echo "<pre>";
  // print_r($result_products);
  // echo "</pre>";

  $parameter = base64_encode(serialize($result_products));
  echo '<div class="col-sm-4"><!-- Start a column -->' . "\n";
  echo '  <div class="card">' . "\n";
  echo '    <img class="card-img-top" src="./images/' . $result_products["image"] . '" alt="' . $result_products["name"] . '">' . "\n";
  echo '    <div class="card-body">' . "\n";
  echo '      <h3 class="card-title">' . $result_products["name"] . '</h5>' . "\n";
  echo '      <h5 class="card-title pricing-card-title">' . $result_products["price"] . '<small class="text-muted"> kr</small></h1>' . "\n";
  echo '      <p class="card-text">' . $result_products["description"] . '.</p>' . "\n";
  echo '      <a href="order.php?parameter=' . $parameter . '" class="btn btn-primary">Order</a>' . "\n";
  echo '    </div>' . "\n";
  echo '  </div>' . "\n";
  echo '</div><!-- end a column -->' . "\n";

} // end while

echo '</div> <!-- row -->' . "\n";

include ("./includes/footer.php");
?>
