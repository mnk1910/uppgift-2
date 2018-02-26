<?php

$title = "Welcome to ACME web shop";
include ("./includes/top.php");

$products = [
    ["Sony headphones", "img1.jpg", "zO3so33OVnaSSvmh", "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.", "1 000"],
    ["Laptop", "img2.jpg", "6cKJEvIHIX1QGUUX", "Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.", "15 000"],
    ["Earpods", "img3.jpg", "KagUNayWpim9tJdF", "Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.", "150"],
];

echo '<div class="row">' . "\n";

foreach($products as $product){

  $parameter = base64_encode(serialize($product));
  echo '<div class="col-sm-4"><!-- Starta en kolumn -->' . "\n";
  echo '  <div class="card">' . "\n";
  echo '    <img class="card-img-top" src="./images/' . $product[1] . '" alt="' . $product[0] . '">' . "\n";
  echo '    <div class="card-body">' . "\n";
  echo '      <h3 class="card-title">' . $product[0] . '</h5>' . "\n";
  echo '      <h5 class="card-title pricing-card-title">' . $product[4] . '<small class="text-muted"> kr</small></h1>' . "\n";
  echo '      <p class="card-text">' . $product[3] . '.</p>' . "\n";
  echo '      <a href="order.php?parameter=' . $parameter . '" class="btn btn-primary">Order</a>' . "\n";
  echo '    </div>' . "\n";
  echo '  </div>' . "\n";
  echo '</div><!-- avsluta en kolumn -->' . "\n";


} // avsluta foreach

echo '</div> <!-- row -->' . "\n";

include ("./includes/bottom.php");
?>
