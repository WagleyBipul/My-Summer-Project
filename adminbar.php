<?php 

 ob_start();
 $currentFile = $_SERVER["PHP_SELF"];
$parts = explode('/', $currentFile);
$currentPage = end($parts);
$currentPage = str_replace('.php', '', $currentPage); 
 if(!isset($_SESSION['loggedin'])|| $_SESSION['loggedin']!==true){
    header("Location:loginpage.php");
   }
//    $name=$_SESSION['user'];
//    echo $name;
   
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
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"> -->
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@700&display=swap" rel="stylesheet">
    <!--font-family: 'Raleway', sans-serif;-->
    <link rel="favicon" type="text/css" href="#favicon">
    <!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: whitesmoke;
            font-family: arial, calibri, 'sans-seriff';
            /* font-size: 10px; */
        }
        #show-btn{
            margin-left:80px;
            position: fixed;
            margin-top:-10px;
            border: none;
        }
        #go-btn{
            margin-left:-250px;
        }

        a {
            text-decoration: none;
        }

        li {
            list-style: none;
        }

        .navbar-container 
        {
          margin-left:5%;
          margin-right:5%;
        }

        .navbar 
        {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1%;
            background-color:Green;
            box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 9999;
        }

        .nav-links a {
            color: rgb(0, 0, 0); /* defines text color */
            /* margin: 2%; */
            color: white;
            font-size:16px;
            font-weight:bold;

        }

        .nav-links li a:hover {
            /* background-color: #f0eeff; */
            color: #F9AD57; /* Green text color on hover */
        }

        .logo {
            height: auto;
            width: auto;
            margin-left: 2%;
        }

        .menu {
            margin-right: 2%;
            display: flex;
            float: right;
            gap: 1em;
            font-size: 1.5em;
        }

        .nav-links .menu {
            margin-right: 3%;
        }

        menu li {
            /* font-size:10px; */
        }

        .menu-item {
            position: relative;
        }

        .menu-item:first-child {
            margin-left: 300%; 
        }


        .sidebar {
            width: 0; /* Initial width set to 0 */
            transition: width 0.3s ease; 
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            margin-left:-190px;
            background-color: Green;
            box-shadow: 3px 0 6px rgba(0, 0, 0, 0.3);
            display: grid;
            grid-template-rows: auto auto 1fr auto; /* Header, Logo, Content, Footer */
            align-items: center; /* Center content vertically */
        }
        .sidebar.sidebar-visible {
            width: 13%;
            margin:0px;
            transition: margin-left 0.4s ease;  /* Width when the sidebar is visible */
        }
       

        .nav-links1 a
        {
            color: white;
            text-align: center;
            text-decoration: none;
            font-size:1em;
            font-weight:bold;
        }
        .nav-links1 a:hover
        {
            color: olive;
            background:lightgreen;
            border:1px solid white;
            padding:10px;
            border-radius:3px;
            
        }
        .nav-links1 a.active {
    color:lightgreen; /* Change this to the desired color */
    font-weight: bold; /* Optionally make the text bold */
}
        .nav-links1 {
            margin-top: 4em;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1em; /* Gap between menu items */
        }

        li
        {
            text-decoration: none;
            list-style: none;

        }
        .nav-links1 li {
            margin: 0; /* Reset margin for menu items */
        }
       
    </style>
    <script defer>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('show-btn').addEventListener('click', function () {
            var sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('sidebar-visible');
            var showBtn = document.getElementById('show-btn');
            if (sidebar.classList.contains('sidebar-visible')) {
                showBtn.style.marginLeft = '-280px';
                
                
              
            } else {
                showBtn.style.marginLeft = '82px';
                
            }
        });
    });
</script>
</head>

<body>
   
</div>
    <div class="navbar-container">
        <nav class="navbar">
            <ul class="nav-links">
                <div class="menu">
                    <li class="menu-item"><a href="Home.php?name=$name">Home</a></li>
                    <li class="menu-item"><a href="Users.php">Users</a></li>
                    <li class="menu-item"><a href="Logout.php">Logout</a></li>
                </div>
            </ul>
        </nav>
    </div>
    <div class="sidebar">
    <div class="logo">
        <a href="admin.php">
            <img src="small_logo.png" class="logo_small" />
        </a>
    </div>
    <ul class="nav-links1" >
        <li class="menu-item" id="burger-btn">
           <img src="menu.png"  ame="btn" value="Show" id="show-btn"style="height:40px; width:40px; padding:5px;"><br>
        </li>
            <li><a href="Admin.php" <?php if ($currentPage === 'Admin') echo 'class="active"'; ?>>Dashboard</a></li>
                        <li><a href="orderstatus.php" <?php if ($currentPage === 'orderstatus') echo 'class="active"'; ?>>Order Status</a></li>
                        <li><a href="Addproducts.php"<?php if ($currentPage === 'Addproducts') echo 'class="active"'; ?>>Add Products</a></li>
                        <li><a href="Allproducts.php"<?php if ($currentPage === 'Allproducts') echo 'class="active"'; ?>>All Products</a></li>
                        <li><a href="Deliveredorders.php" <?php if ($currentPage === 'Deliveredorders') echo 'class="active"'; ?>>Delivered Orders</a></li>
                        <li><a href="Adminfutsal.php" <?php if ($currentPage === 'Adminfutsal') echo 'class="active"'; ?>>Admin Futsal</a></li>
                        <li><a href="Admincricsal.php" <?php if ($currentPage === 'Admincricsal') echo 'class="active"'; ?>>Admin Cricsal</a></li>
                        <li><a href="pending_orders.php" <?php if ($currentPage === 'pending_orders') echo 'class="active"'; ?>>Pending Orders</a></li>
            </ul></ul>
    </div>
</body>
</html>
<?php 

error_reporting(E_ALL & ~E_NOTICE);

  include "connection.php";
//   if(!isset($_SESSION['loggedin'])|| $_SESSION['loggedin']!==true){
//     header("Location:loginpage.html");
//    }
   ob_end_flush();
?>
