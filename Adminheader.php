<!DOCTYPE html>
<html>
<head>
	<title>Velocity</title>
	<meta charset="UTF-8">
    <meta name="description" content="test">
    <meta name="keywords" content="HTML, CSS, BOOTSTRAP">
    <meta name="author" content="Anik">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@700&display=swap" rel="stylesheet">
    <!--font-family: 'Raleway', sans-serif;-->
    <link rel="favicon" type="text/css" href="#favicon">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
    <style>
           .nav-item{
            background:green;
           }
      </style>

</head>

<body>
  
<?php 
error_reporting(E_ALL & ~E_NOTICE);
  session_start();
  include "connection.php";
  if(!isset($_SESSION['loggedin'])|| $_SESSION['loggedin']!==true){
    header("Location:loginpage.html");
   }

?>
<nav class="navbar">
  <div class="container">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar" style="background:green;" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="Admin.php">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="Orderstatus.php">Order Status</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Addproducts.php">Add Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Allproducts.php">All Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Deliveredorders.php">Delivered Orders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Adminfutsal.php">Admin Futsal</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Admincricsal.php">Admin Cricsal</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pending_orders.php">Pending Orders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Users.php">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Logout.php">Logout</a>
        </li>
        <li class="nav-item">
         </ul>

    </div>
  </div>
</nav>

<!--nav end--->