<?php

$title = "Checkout form";
include ("./includes/header.php");

$error_get = '';

// Check if the data was passed correctly by index.php
if (!isset($_GET['parameter']) || empty($_GET['parameter'])){
    $error_get = 'Incorrect parameter, please try again. ';
}

// Display all php server variables available with their values
// print_r ($_SERVER);
// Check if the page was accessed directly or was invoked by index.php as requested
if (!isset($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER'] != $http_referer){
    $error_get .= 'You can not load this page directly. ';
}

// Check if the form down the page was used
if (isset($_POST['action']) && ($_POST['action'] == 'update')){
$error_post = '';

// Check the parameters sent via POST by the form
if (!isset($_POST['customer_name']) || empty ($_POST['customer_name']) || !isset($_POST['customer_mail']) || empty ($_POST['customer_mail']) || !isset($_POST['customer_address']) || empty ($_POST['customer_address']) || !isset($_POST['customer_phone']) || empty ($_POST['customer_phone'])){
    $error_post = 'Error processing the checkout form. ';
}

// Display an error message if there are problems with the POST data
if ($error_post){
?>
    <div class="jumbotron p-3 p-md-5 rounded">
          <div class="card flex-md-row mb-4 h-md">
            <div class="card-body d-flex flex-column">
              <h3 class="mb-0">
                <div class="alert alert-danger" role="alert"><?=$error_post ?></div>
              </h3>
            </div>
          </div>
    </div>
    <?php
    } else {
        // no errors found, order is complete!
?>

<div class="jumbotron p-3 p-md-5 rounded">
      <div class="card flex-md-row mb-4 h-md">
        <div class="card-body d-flex flex-column">
          <h3 class="mb-0">
            <div class="alert alert-success" role="alert">Your order has been successfully placed!</div>
          </h3>
          <div class="container">
              <p class="float-left">
              <a href="<?=$http_referer?>" class="btn btn-outline-success">Go to the index page.</a>
              </p>
          </div>
          <?php
          // use the available data (GET and POST) and insert it into the database
          // note: $_GET is serialized and encoded.
          // print_r ($_GET);
          // print_r ($_POST);

          // Decoding the $_GET['parameter'] passed by index.php
          $decoded = base64_decode($_GET['parameter']);
          // and convert the resulted string back to an array
          $parameters = unserialize($decoded);

          $product_id = $parameters['product_id'];

          // Log the order details into order_log MySQL table as requested for VG
          $query_order_log = "INSERT INTO order_log SET product_id='" . $product_id . "', customer_name='" . $_POST['customer_name'] . "', customer_mail='" . $_POST['customer_mail'] . "', customer_phone='" . $_POST['customer_phone'] . "', customer_address='" . $_POST['customer_address'] . "'";
          // check the generated SQL INSERT query
          // echo $query_order_log;
          $sql_order_log = mysqli_query($connection, $query_order_log);
          ?>
        </div>
      </div>
</div>

<?php
        include ("./includes/footer.php");
        exit;
    } // end else
}
// Display an error message if there was a problem with the data sent via GET by the previous page
if ($error_get){
?>
<div class="jumbotron p-3 p-md-5 rounded">
      <div class="card flex-md-row mb-4 h-md">
        <div class="card-body d-flex flex-column">
          <h3 class="mb-0">
            <div class="alert alert-danger" role="alert"><?=$error_get ?></div>
          </h3>
        </div>
      </div>
</div>
<?php
}
else{
    // No GET errors found, display the ordered product's details.

    // Decoding the $_GET['parameter'] passed by index.php
    $decoded = base64_decode($_GET['parameter']);
    // and convert the resulted string back to an array
    $parameters = unserialize($decoded);

    // echo "<pre>";
    // print_r($_GET);
    // echo "</pre>";

    // Get the values from the newly decoded array
    $product_name = $parameters['name'];
    $img = $parameters['image'];
    $product_id = $parameters['product_id'];
    $product_description = $parameters['description'];
    $product_price = $parameters['price'];

    // Populate page with the data of the ordered product
?>
<div class="jumbotron p-3 p-md-5 rounded">
          <div class="card flex-md-row mb-4 h-md">
            <div class="card-body d-flex flex-column">
              <h3 class="mb-0">
                <strong class="d-inline-block mb-2 text-primary"><?php echo $product_name; ?></strong>
              </h3>
              <div class="mb-2 text-muted">Product Nr: <?=$product_id ?></div>
              <div class="card-title pricing-card-title">Price: <?=$product_price ?> <small class="text-muted">kr</small></div>
              <p class="card-text mb-auto"><?=$product_description ?></p>
            </div>
            <img class="card-img-right flex-auto d-none d-md-block" src="./images/<?=$img ?>" src="holder.js/200x250?theme=thumb" alt="Card image cap">
          </div>
</div>
<h2 class="mb-2">To finalize your order, please fill in the following form:</h2>
    <form action="order.php?parameter=<?=$_GET['parameter'] ?>" method="POST" name="order">
        <div class="row">
            <div class="col-md-6 mb-3">
                    <label for="Name">Name</label>
                    <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Your name" value="" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                    <label for="Email">Email</label>
                    <input type="email" class="form-control" id="customer_mail" name="customer_mail" placeholder="Your email" value="" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                    <label for="Phone number">Phone number</label>
                    <input type="text" class="form-control bfh-phone" data-country="SV" id="customer_phone" name="customer_phone" placeholder="Your phone number" value="" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                    <label for="Address">Delivery address</label>
                    <input type="address" class="form-control" id="customer_address" name="customer_address" placeholder="Your address" value="" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                    <label for="Message">Message</label>
                    <textarea cols="50" rows="5" type="text" class="form-control" id="customer_message" name="customer_message" placeholder="Your message"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Place the order</button>
            </div>
        </div>
        <input type="hidden" name="action" value="update">
    </form>

<?php
} // end else for the case in which no GET errors are found ->display the ordered product's details.

include ("./includes/footer.php");
?>
