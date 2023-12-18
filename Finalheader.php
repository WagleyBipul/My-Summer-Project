<?php  
error_reporting(E_ALL & ~E_NOTICE);
session_start();
  if (isset($_SESSION['user'])) 
  {
   $user=$_SESSION['user'];
  }
  if(isset($_SESSION['admin'])){
    $user="admin";
  }
  if(!isset($_SESSION['user']) && !isset($_SESSION['admin'])){
    $user="Visitor Mode";
  }


   ?>
<!DOCTYPE html>
<html>
<head>
	<title>Velocity</title>
	<meta charset="UTF-8">
    <meta name="description" content="test">
    <meta name="keywords" content="HTML, CSS, BOOTSTRAP">
    <meta name="author" content="Bipul">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@700&display=swap" rel="stylesheet">
    <!--font-family: 'Raleway', sans-serif;-->
    <link rel="favicon" type="text/css" href="#favicon">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
    <style >
      .nav-link{
        margin:5px;
       
      }
  #navbarSupportedContent ul li a{
    color:green;
  }
  #navbarSupportedContent ul li a:hover{
    color:white;
    background:green;
    border:1px solid green;
    border-radius:20px;
  }
  .container{
     grid-template-rows:100px 500px;
  }
  
 </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light ">
  <div class="container" >
    

    <div class="collapse navbar-collapse"   style="background-color:Green; width:100%; font-weight:600; " id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto"style="color:white;">
        <li class="nav-item">
          <a class="nav-link" style="color:white;  border-radius:0px; " href="Home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" style="color:white; border-radius:0px;" href="Store.php">Store</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" style="color:white; border-radius:0px;" href="Futsalbooking.php">Futsal Booking</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" style="color:white; border-radius:0px; " href="Cricsalbooking.php">Cricsal Booking</a>
        </li>   

           <?php if($user=="Visitor Mode") { ?>  
                      <li class="nav-item">
                      <a class="nav-link" href=" "></a>
                    </li>
                  <li class="nav-item">
                    <a class="nav-link" href=" "></a>
                  </li>
            

            <?php  }
            else { ?>    <li class="nav-item">
              <a class="nav-link" style="color:white; border-radius:0px; "  href="Mybookings.php">My Bookings</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" style="color:white; border-radius:0px; "  href="Cart.php">Cart</a>
            </li>  
            <li class="nav-item">
              <a class="nav-link" style="color:white; border-radius:0px; "  href="Profile.php">My Profile</a>
            </li>  <?php   }?>
      
 
        
      </ul>
      <!-- <form class="form-inline"  action="search(1).php" method="post">
        
        <input class="form-control" type="search" placeholder="Search" aria-label="Search" name="name">
        <button class="btn btn-outline-dark" type="submit" style="margin-left:px;margin-right:7px;"><img src="search.png"></button>
        </form> -->
               
        <?php
          $total=0;
        //   if (mysqli_num_rows($result) > 0) {
        //     // output data of each row
        //     while($row = mysqli_fetch_assoc($result)) {
        //       $total++;
        //     }
        //   }
              ?>
        <!-- <a href="search.php"><img src="cart.png"><?php echo $total?></a> --> 
        <!-- <label for="Options">Actions:</label> -->
        <li class="nav">
          <a class="nav-link" style="color:white; border-radius:0px; margin-left:20px; line" href="contactus.php">Contact Us</a>
        </li>
        <li class="nav">
  <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { ?>
    <button class="button primary" style ="color:white; padding:5px 5px; margin-right:5px; background-color:#000029; border:none;" onclick="location.href='Logout.php';">Logout</button>
 
  <?php } else { ?>
    <button class="button primary" onclick="location.href='Loginpage.php';" style ="color:white; padding:5px 5px; margin-right:5px; background:green; font-weight:600; border:none;">Login</button>
  <?php } ?>
</select>

<script>
document.getElementById("options").addEventListener("change", function() {
  var selectedValue = this.value;
  
  if (selectedValue === "Logout") {
    window.location.href = "Logout.php";
  } else if (selectedValue === "Myorders") {
    window.location.href = "Cart.php";
  } else if (selectedValue === "Mybookings") {
    window.location.href = "Mybookings.php";
  } else if (selectedValue === "Login") {
    window.location.href = "Loginpage.php";
  }
});
</script>

<?php 
      
      ?>
</div>
    </div>
</nav>
</body>
</html>