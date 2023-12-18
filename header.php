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

</head>

<body>
  
<?php 
  SESSION_START();
  include "connection.php";
  $id=$_SESSION['userid'];
 $sql = "SELECT * FROM cart where userid='$id'";
 $result = $conn -> query ($sql);
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php">Futsal Booking</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php">Cricsal Booking</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php">My Bookings</a>
        </li>
        <li class="nav-item">
        
      </ul>
      <form class="form-inline"  action="search(1).php" method="post">
        <!--<a href=""><img src="img/search.png"></a>-->
        <input class="form-control" type="search" placeholder="Search" aria-label="Search" name="name">
        <button class="btn btn-outline-dark" type="submit" style="margin-left:7px;margin-right:7px;"><img src="img/search.png"></button>
        </form>
        <?php
          $total=0;
          if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
              $total++;
            }
          }
              ?>
        <a href="cart(1).php"><img src="img/cart.png"><?php echo $total?></a>
        <?php 

// if(isset($_SESSION['loggedin']))
// {
//    if($_SESSION['loggedin']==true)
//    {
//     echo $_SESSION['username']; ?>
//     <a href="profile.php">(My Orders)</a>
//     <a href="logout.php">(logout)</a>
// <?php
//    }
// }
// else
// {
// ?>
//   <!-- <a href="login.php">Login</a>
//   <a href="Register.php">Signup</a> -->
// <?php
// }
// ?>
        

    </div>
  </div>
</nav>

<!--nav end--->