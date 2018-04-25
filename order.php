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
if (!isset($_SERVER['HTTP_REFERER']) || empty($_SERVER['HTTP_REFERER'])){
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
          <h3 class="mb-0 text-center">
            <div class="alert alert-success" role="alert">Your order has been successfully placed!</div>
          </h3>
          <!-- <div class="container">
              <p class="float-center">
              <a href="./index.php" class="btn btn-outline-success">Go to the index page.</a>
              </p>
          </div> -->
          <?php
          // use the available data (GET and POST) and insert it into the database
          // note: $_GET is serialized and encoded.
          // print_r ($_GET);
          // print_r ($_POST);

          // Decoding the $_GET['parameter'] passed by index.php
          $decoded = base64_decode($_GET['parameter']);
          // and convert the resulted string back to an array
          $parameters = unserialize($decoded);

          // Get the values from the newly decoded array
          $product_id = $parameters['product_id'];
          $product_name = $parameters['name'];
          $product_price = $parameters['price'];

          // Log the order details into order_log MySQL table as requested for VG
          $query_order_log = "INSERT INTO order_log SET product_id='" . htmlspecialchars($product_id) . "', customer_name='" . htmlspecialchars($_POST['customer_name']) . "', customer_mail='" . htmlspecialchars($_POST['customer_mail']) . "', customer_phone='" . htmlspecialchars($_POST['customer_phone']) . "', customer_address='" . htmlspecialchars($_POST['customer_address']) . "'";
          // check the generated SQL INSERT query
          // echo $query_order_log;
          $sql_order_log = mysqli_query($connection, $query_order_log);
          ?>
        </div>
    </div>
</div>
<div class="card-body d-flex flex-column">
    <h5 class="mb-0 text-center">
            <div class="text-secondary">
                <table class="table table-bordered">
                    <thead><tr>
                        <th scope="col">Product No.</th>
                        <th scope="col">Product name</th>
                        <th scope="col">Price</th>
                    </tr></thead>
                    <tbody><tr>
                        <td><?php echo $product_id ?></td>
                        <td><?php echo $product_name ?></td>
                        <td><?php echo $product_price ?></td>
                    </tr></tbody>
                </table>
            </div>
    </h5>
</div>
<!-- <hr class="mb-4"> -->
<div class="row">
    <div class="col-sm-6 text-secondary text-center">
        <ul class="list-unstyled"><strong>Delivery address:</strong>
            <li><?php echo $_POST['customer_name'] ?></li>
            <li><?php echo $_POST['customer_address'] ?></li>
        </ul>
    </div>
    <div class="col-sm-6 text-secondary text-center">
        <ul class="list-unstyled"><strong>Contact details:</strong>
            <li><?php echo $_POST['customer_mail'] ?></li>
            <li><?php echo $_POST['customer_phone'] ?></li>
        </ul>
    </div>
</div>
        <p class="container text-center">
            <a href="./index.php" class="btn btn-outline-primary">Go to the index page.</a>
        </p>

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
<?php
// $_SERVER['PHP_SELF'] - current opened file
?>
<h2 class="mb-2">To finalize your order, please fill in the following form:</h2>
    <form action="<?=$_SERVER['PHP_SELF'] ?>?parameter=<?=$_GET['parameter'] ?>" method="POST" name="order">
        <div class="row">
            <div class="col-md-6 mb-3">
                    <label for="Name">Name *</label>
                    <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Your name" value="" maxlength="45" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                    <label for="Email">Email *</label>
                    <input type="email" class="form-control" id="customer_mail" name="customer_mail" placeholder="Your email" value="" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                    <label for="Phone number">Phone number *</label>
                    <input type="tel" pattern='^[0-9\-\+\s]*$' title='Only numbers (0-9), - sign, + sign and space are allowed.'
                    class="form-control bfh-phone" data-country="SV" id="customer_phone" name="customer_phone" placeholder="Your phone number" value="" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                    <label for="Address">Delivery address *</label>
                    <input type="address" class="form-control" id="customer_address" name="customer_address" placeholder="Your address" value="" required>
                    <small id='passwordHelpBlock' class='form-text text-muted'>
                            * All fields must be completed.
                    </small>
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
                <input type='reset' value='Clear' class='btn btn-outline-primary'><br><br>
                <button class="btn btn-primary btn-lg btn-block" type="submit">Place the order</button>
            </div>
        </div>
        <input type="hidden" name="action" value="update">
    </form>

<?php
} // end else - for the case in which no GET errors are found ->display the ordered product's details.

include ("./includes/footer.php");
?>
