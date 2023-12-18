<?php
  session_start();

include'adminbar.php';
include 'connection.php';
if(!isset($_SESSION['loggedin'])|| $_SESSION['loggedin']!==true){
    header("Location:loginpage.html");
   }
$num=$num2=$num3=$num8=$num9=0;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>  
    body
    {
        background:white;
        /* margin-left:10%; */
    }
    .variousinfos{
        display:grid;
        grid-template-columns:300px 300px 300px;
        /* box-shadow: 3px 0 6px rgba(0, 0, 0, 0.3); */
        /* border:1px dotted whitesmoke; */
    }
    .users{
        /* border:1px solid green; */
        height:100px;
        width:200px;
        background: #096b72;
        color:white;
        text-align:center;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 3px 0 6px rgba(0, 0, 0, 0.3);
        border-radius:5px;
        margin-left:200px;
        margin-top:100px;
        font-size:1.2em;
        opacity:0.8; 
        transform: translate(50%,-3%);

    }
    .users:hover{
        position: absolute;
        background-color: rgba(255, 255, 255, 0.5); /* Set your hover background color */
        opacity: 1; /* Initially invisible */
        transition: opacity 0.3s ease;
        z-index: 1;
      
    }

    .products{
        /* border:1px solid green; */
        height:100px;
        width:200px;
        background:white;
        color:white;
        text-align:center;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 3px 0 6px rgba(0, 0, 0, 0.3);
        border-radius:5px;
        margin-left:200px;
        margin-top:100px;
        transform: translate(30%,-3%);
        font-size:1.2em;
       
        opacity:0.8; 
       
    }
    .products h5
    {
        margin-top:-50px;
        margin-left:-60px;
        font-weight:bold;
    }
    .product{
        margin-left:-50px;
        margin-top:30px;
        font-weight:bold;
    }
    .orders{
        /* border:1px solid green; */
        height:100px;
        width:200px;
        background:white;
        color:white;
        text-align:center;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 3px 0 6px rgba(0, 0, 0, 0.3);
        border-radius:5px;        
        margin-left:200px;
        margin-top:100px;
        transform: translate(10%,-3%);
        font-size:1.2em;
        opacity:0.8;
    }
    .orders h5{
        margin-top:-50px;
        margin-left:-60px;
        font-weight:bold;
    }
    .order{
        margin-left:-50px;
        margin-top:30px;
        font-weight:bold;
    }
    
    .users h5{
        margin-top:-50px;
        margin-left:-60px;
        font-weight:bold;
    }
    .user{
        margin-left:-50px;
        margin-top:30px;
        font-weight:bold;
    }
    h2{
        margin-left:400px;
        margin-top:50px;
        background:green;
        color:white;
        width:300px;
        text-align:center;
        animation:dash 1s infinite;
        font-weight:bold;
    }
    @keyframes dash {
        0%{ background:olive;}
        50%{ background:Green; border:1px solid white; border-radius:10px;}

        100%{ background:olive;}
        
    }
    .usersanimation{
        color:white;
        font-weight:bold;
    }
   .variousinfos a{
        text-decoration:none;font-weight:bold;
    }
    .users:hover
    {
    background:olive;
    color:white;
    box-shadow: 100 px 100px 100 rgba(0, 0, 0, 0.8), 200 106px 200px 100 rgba(0, 0, 0, 0.19);
    }
    .orders:hover
    {
        position: absolute;
        opacity:1; 
        background-color: rgba(255, 255, 255, 0.5); /* Set your hover background color */
        opacity: 1; /* Initially invisible */
        transition: opacity 0.3s ease;
        z-index: 1;
    box-shadow: 100 px 100px 100 rgba(0, 0, 0, 0.8), 200 106px 200px 100 rgba(0, 0, 0, 0.19);
    }
    .products:hover
    {
        position: absolute;
        opacity:1; 
        background-color: rgba(255, 255, 255, 0.5); /* Set your hover background color */
        opacity: 1; /* Initially invisible */
        transition: opacity 0.3s ease;
        z-index: 1;
       box-shadow: 100 px 100px 100 rgba(0, 0, 0, 0.8), 200 106px 200px 100 rgba(0, 0, 0, 0.19);
    }
        .guff h1
        {
            /* margin-bottom:5%; */
            margin-top:5.5%;
            font-size: 2em;
            font-weight: lighter;
            margin-left:33%;
        }
        .line
        {
            height: 1px;
            max-width:500px;
            color: grey;
            opacity: 20%;
            margin-top: 0.5%;
            margin-left:29.8%; 
        }
        .orders:hover,
.products:hover {
    position: static; /* Change to 'static' to remove absolute positioning */
    opacity: 2; /* Set the initial opacity */
    background-color: white; /* Set the initial background color */
    box-shadow: 3px 0 6px rgba(0, 0, 0, 0.3); /* Set the initial box shadow */
    /* Set the initial z-index */
}
    </style>

</head>
<body>
    
    <div class="container homebody" >

        <div class="guff" >
            <h1>Welcome to the Admin Panel</h1>
            <hr class="line">
        </div>

        <!-- <div class="row">
            <div class="col-md-12">
                <h1>Hello !! Admin Welcome to Admin Panel !! </h1>
        </div> -->
        </div>
        <?php
        $todaydate=date("Y-m-d");

        $sql1="SELECT * FROM registeruser";
        $result1=mysqli_query($conn,$sql1);
        $numofusers1=mysqli_num_rows($result1);
        $sql2="SELECT * FROM product";
        $result2=mysqli_query($conn,$sql2);
        $numofproducts2=mysqli_num_rows($result2);
        $sql3="SELECT * FROM orders";
        $result3=mysqli_query($conn,$sql3);
        $total3=mysqli_num_rows($result3);
        
        $sql5="SELECT * FROM booking";
        $result5=mysqli_query($conn,$sql5);

        $sql9="SELECT * FROM cricsalbooking";
        $result9=mysqli_query($conn,$sql9);


        $sql6="SELECT * FROM booking WHERE bookday='$todaydate'";
        $result6=mysqli_query($conn,$sql6);
        $aajakofutsal=mysqli_num_rows($result6);

        $sql7="SELECT * FROM cricsalbooking WHERE bookday='$todaydate'";
        $result7=mysqli_query($conn,$sql7);
        $aajakocricsal=mysqli_num_rows($result7);
      
      
        if (mysqli_num_rows($result3) > 0) {
            // output data of each row
            while($row4= mysqli_fetch_assoc($result3)) {

           $time=$row4["created_at"];
          $samaya=substr($time, 0, 10);
          if($samaya==$todaydate)
          {
            $num+=1;
          }
        //   $result4=mysqli_query($conn,$sql4);
          $numoftodays=$num;
        //   mysqli_num_rows($result4);
          
    
            }}
            if (mysqli_num_rows($result5) > 0) {
                // output data of each row
                while($row5= mysqli_fetch_assoc($result5)) {
    
               $time=$row5["created_at"];
              $samaya=substr($time, 0, 10);
              if($samaya==$todaydate)
              {
                $num2+=1;
              }
              
            //   $result4=mysqli_query($conn,$sql4);
              $numoftodays2=$num2;
            //   mysqli_num_rows($result4);
              
        
                }}
                if (mysqli_num_rows($result9) > 0) {
                    // output data of each row
                    while($row9= mysqli_fetch_assoc($result9)) {
        
                   $time9=$row9["created_at"];
                  $samaya9=substr($time9, 0, 10);
                  if($samaya9==$todaydate)
                  {
                    $num9+=1;
                  }
                  
                //   $result4=mysqli_query($conn,$sql4);
                  $numoftodays9=$num9;
                //   mysqli_num_rows($result4);
                  
            
                    }}

                $sql8="SELECT * FROM registeruser";
                $result8=mysqli_query($conn,$sql8);
                $aajakouser=mysqli_num_rows($result8);
                if (mysqli_num_rows($result8) > 0) {
                    // output data of each row
                    while($row8= mysqli_fetch_assoc($result8)) {
        
                   $time=$row8["created_at"];
                  $samaya=substr($time, 0, 10);
                  if($samaya==$todaydate)
                  {
                    $num8+=1;
                  }
                  
                //   $result4=mysqli_query($conn,$sql4);
                  $numoftodays8=$num8;
                //   mysqli_num_rows($result4);
                  
            
                    }}
            // var_dump($result4);
        ?>
        <!-- <h2>Dashboard</h2> -->

        <div class="variousinfos" style="margin-left:-100px;"  >
           <a href="Users.php"> 
            <div class="users" style="margin-top:99px; background:white;">
            <img src="user.png" style="height:50px; width:50px;margin-left:-50px; color:white;">
                    <h5 style="margin-left:21px; color:Green">Users</h5><br> 
                    <p class="user" style="margin-left:-30px; color:Green"><?php echo $numofusers1 ?>
                </div>
            </a>
           <a href="Allproducts.php">  
                <div class="products">
                <img src="procurement.png" style="height:50px; width:50px;margin-left:-50px; color:white;">
                    <h5 style="margin-left:21px; color:Green">Product</h5><br>
                    <p class="product" style="margin-left:-30px; color:Green"><?php echo $numofproducts2  ?>
                </div>
            </a>
           <a href="Orderstatus.php"> 
                <div class="orders"> 
                <img src="bell.png" style="height:50px; width:50px;margin-left:-50px; color:white;">
                    <h5 style="margin-left:21px; color:Green;"> Orders</h5><br>
                    <p class="order" style="margin-left:-30px; color:Green"><?php echo $total3  ?>   
                </div>
            </a>
        </div><br>
        <h4 style=" margin-left:300px;margin-top:10px;"> Orders Created Today</h4>
        <div class="variousinfos" style="margin-top:-20px; margin-left:-100px;">
           <a href="Admin.php"> 
            <div class="users" style="margin-top:99px; background:white;">
            <img src="user.png" style="height:50px; width:50px;margin-left:-50px; color:white;">
                    <h5 style="margin-left:21px; color:Green">Orders Today</h5><br> 
                    <p class="user" style="margin-left:-60px; color:Green"><?php echo $numoftodays; ?>
                </div>
            </a>
            <a href="Admin.php"> 
                <div class="products">
                <img src="procurement.png" style="height:50px; width:50px;margin-left:-50px; color:white;">
                    <h5 style="margin-left:1px; color:Green">Futsal Bookings</h5><br>
                    <p class="product" style="margin-left:-50px; color:Green"><?php echo $numoftodays2  ?>
                </div>
            </a>
            <a href="Admin.php"> 
                <div class="orders"> 
                <img src="bell.png" style="height:50px; width:50px;margin-left:-70px; color:white;">
                    <h5 style="margin-left:1px; color:Green;">Cricsal Bookings</h5><br> 
                    <p class="order" style="margin-left:-93px; color:Green"><?php echo $numoftodays9  ?>   
                </div>
            </a>
            
        </div>
        
    </div>
    </div>
    <a href="Admin.php"> 
                <div class="orders" style="margin-left:1000px; margin-top:-220px;"> 
                <img src="bell.png" style="height:50px; width:50px; margin-left:-30px; color:white;">
                    <h5 style="margin-left:-12px; color:Green;">Futsal For Today</h5><br>
                    <p class="order" style="margin-left:-30px; color:Green"><?php echo $aajakofutsal;  ?>   
                </div>
            </a>
            <a href="Admin.php"> 
                <div class="orders" style="margin-left:1000px; margin-top:-200px;"> 
                <img src="bell.png" style="height:50px; width:50px; margin-left:-30px; color:white;">
                    <h5 style="margin-left:-12px; color:Green;">Cricsal For Today</h5><br>
                    <p class="order" style="margin-left:-30px; color:Green"><?php echo $aajakocricsal ?>   
                </div>
            </a>
            <a href="Admin.php"> 
                <div class="orders" style="margin-left:1000px; margin-top:-200px;"> 
                <img src="bell.png" style="height:50px; width:50px; margin-left:-30px; color:white;">
                    <h5 style="margin-left:-12px; color:Green;">Users Joined Today</h5><br>
                    <p class="order" style="margin-left:-30px; color:Green"><?php echo $numoftodays8; ?>   
                </div>
            </a>
</body>
</html>