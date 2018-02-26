<?php

$title = "Checkout form";
include ("./includes/top.php");

$error_get = '';

if (!isset($_GET['parameter']) || empty($_GET['parameter'])){
    $error_get = 'Incorrect parameter, please try again. ';
}

$decoded = base64_decode($_GET['parameter']);
$parameters = unserialize($decoded);

$product_name = $parameters['0'];
$img = $parameters['1'];
$product_id = $parameters['2'];
$product_description = $parameters['3'];
$product_price = $parameters['4'];

if (isset($_POST['action']) && ($_POST['action'] == 'update')){
$error_post = '';

if (!isset($_POST['customer_name']) || empty ($_POST['customer_name']) || !isset($_POST['customer_mail']) || empty ($_POST['customer_mail']) || !isset($_POST['customer_address']) || empty ($_POST['customer_address'])){
    $error_post = 'Error processing the billing form. ';
}

$to = $_POST['customer_mail'];
$subject = 'Order placed by ' . $_POST['customer_name'];
$headers = "From: vrabie@inariptata.com\r\n" . "X-Mailer: php";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$headers .= 'Bcc: ilnitchi@gmail.com';
$message = '<html><body>';
$message .= 'New order for the customer <strong>' . $_POST['customer_name'] . "</strong><br /><br />\n";
$message .= '<strong>Product</strong>: <br />' . $product_name . ' (article id: ' . $product_id . ') ' . "<br /><br />\n";
$message .= '<strong>Product description</strong>: <br />' . $product_description . "<br /><br />\n";

if (!mail($to , $subject, $message, $headers)){
    $error_post .= 'Error sending the customer the confirmation email.';
}

if ($error_post){
?>
    <div class="jumbotron p-3 p-md-5 rounded">
          <div class="card flex-md-row mb-4 h-md">
            <div class="card-body d-flex flex-column">
              <h3 class="mb-0">
                <strong class="d-inline-block mb-2 text-danger"><?php echo $error_post; ?></strong>
              </h3>
            </div>
          </div>
    </div>
    <?php
    } else {
?>

<div class="jumbotron p-3 p-md-5 rounded">
      <div class="card flex-md-row mb-4 h-md">
        <div class="card-body d-flex flex-column">
          <h3 class="mb-0">
            <strong class="d-inline-block mb-2 text-success">Your order has been successfully placed!</strong>
          </h3>
        </div>
      </div>
</div>


<?php
    }
}

if ($error_get){
?>
<div class="jumbotron p-3 p-md-5 rounded">
      <div class="card flex-md-row mb-4 h-md">
        <div class="card-body d-flex flex-column">
          <h3 class="mb-0">
            <strong class="d-inline-block mb-2 text-danger"><?php echo $error_get; ?></strong>
          </h3>
        </div>
      </div>
</div>
<?php
}
else{

?>
<div class="jumbotron p-3 p-md-5 rounded">
          <div class="card flex-md-row mb-4 h-md">
            <div class="card-body d-flex flex-column">
              <h3 class="mb-0">
                <strong class="d-inline-block mb-2 text-primary"><?php echo $product_name; ?></strong>
              </h3>
              <div class="mb-2 text-muted">Product Nr: <?php echo $product_id; ?></div>
              <p class="card-text mb-auto"><?php echo $product_description; ?></p>
            </div>
            <img class="card-img-right flex-auto d-none d-md-block" src="./images/<?php echo $img; ?>" src="holder.js/200x250?theme=thumb" alt="Card image cap">
          </div>
</div>

<h2 class="mb-2">To finalize your order, please fill in the following form:</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']?>?parameter=<?php echo $_GET['parameter']; ?>" method="POST" name="order">
        <div class="row">
            <div class="col-md-6 mb-3">
                    <label for="Name">Name</label>
                    <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Your name" value="" required="">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                    <label for="Email">Email</label>
                    <input type="email" class="form-control" id="customer_mail" name="customer_mail" placeholder="Your email" value="" required="">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                    <label for="Address">Delivery address</label>
                    <input type="address" class="form-control" id="customer_address" name="customer_address" placeholder="Address" value="" required="">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                    <label for="Message">Message</label>
                    <textarea cols="50" rows="5" type="text" class="form-control" id="customer_message" name="customer_message" placeholder="Message"></textarea>
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
}

include ("./includes/bottom.php");

?>
