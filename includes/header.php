<?php
include("./includes/connection.php");
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./css/bootstrap.css" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="./css/blog.css" rel="stylesheet">

    <title>ACME - shop</title>
  </head>
  <body class="container">
    <!-- <body class="container" id="page-top"> -->
        <!-- Navigation -->
        <!-- <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav"> -->
        <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
            <div class="container">
              <a class="navbar-brand text-secondary" href="index.php">ACME webshop</a>
              <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fa fa-bars"></i>
              </button>
              <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item">
                    <a class="nav-link text-primary" href="index.php">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-primary" href="order.php">Order</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-primary" href="orders_log.php">Order history</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-primary" href="contact.php">Contact</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
    <hr class="mb-4">
    <h1><?php echo $title; ?></h1>


