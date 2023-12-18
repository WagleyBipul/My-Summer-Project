<?php

  ob_start();
  
  include 'Finalheader.php';
 include 'connection.php';
 session_start();
//  if(!isset($_SESSION['loggedin'])|| $_SESSION['loggedin']!==true){
//     header("Location:loginpage.html");
//     exit;
//    }
// $loggedin=$_SESSION['loggedin'];
if (isset($_SESSION['loggedin'])) 
{
$loggedin=$_SESSION['loggedin'];

}
else{
    $loggedin="Notloggedin";
    $user_id="Visitor";
}


 $sql = "SELECT * FROM product";
 $result = $conn -> query ($sql);

 if(isset($_POST['add_to_cart'])){
   
       
// if(isset($_SESSION['auth']))
// {
//    if($_SESSION['auth']!=1)
//    {
//        header("location:loginpage.php");
//    }
// }
// else
// {
//    header("location:login.php");
// }

  
  if($loggedin=="true")
{
  $user_id=$_SESSION['user'];;
  $product_name = $_POST['product_name'];
  $proq=$_POST['product_quantity'];
  $product_price = $_POST['product_price'];
  $product_id = $_POST['product_id'];
  $product_quantity = 1;
       if($proq>0){
          $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE productid = '$product_name'  && userid='$user_id'");

        if(mysqli_num_rows($select_cart) > 0){
        echo $message[] = 'product already added to cart';

        }else{
        $insert_product = mysqli_query($conn, "INSERT INTO `cart`(userid, productid, name, quantity, price) 
        VALUES('$user_id', '$product_id', '$product_name', '$product_quantity', '$product_price')");
       echo $message[] = 'product added to cart succesfully'.$product_name;
       header('location:Store.php');
         }

      }
       else{
     echo "<script>alert('Out of stock');</script>";
       }
       
}
else{
  echo "<script>alert('login to perform the action');</script>";
  header('location:loginpage.php');
}
} 

if(isset($_POST['Details'])){
  $prodid=$_POST['imgname'];
  $link = "";
  // echo $link;
  header("Location:Details.php?name=$prodid&anothername=$prodid");
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
 .card{
  /* border: 2px solid yellow; */
    height: 270px;
    width:180px; 
    box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    margin:10px;
    /* transform: translate(30%,5%); */
    background:#E2F1AF;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
 }
 .card .image {
    height: 60%;
    margin-bottom: 20px;
}
.card .image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}


.caption h6 {
    margin-top:-52px;
    padding-left:30px;
    text-align: left;
    line-height:20px;
    word-break:normal;
    font:arial;
    font-weight: medium;
    height: 25%;
    background:#E2F1AF;
    
}
.caption span {

  margin-left:80px;
}
.lowbtns{
  display:grid;
  grid-template-columns:90px 90px;
  font-size:13px;
}
.card button {
    /* border:1px solid green; */
    border-radius:5px;
    box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
   
    width: 70%;
    cursor: pointer;
    margin-top:-1em;
    margin-left:40px;
    font-weight: bold;
   
    position: relative;
    /* height: 280%; */
    background:whitesmoke;
    text-align:center;
}
/* .buttons{
    width:76%;
    background:whitesmoke;

} */

/* .card button:before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    bottom:0;
    width: 0;
    background-color:whitesmoke;
    transition: all 0.5s;
    margin: 0;
} */
.caption .price{
    /* margin-top:-10px; */
    color:red;
    margin-left:-10px;
    background:white;
    text-align:center;
}

.card button:after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    width: 0;
    background-color:green;
    transition: all 0.5s;
} 

.card button:hover::before {
    width: 5%;
}

.card button:hover::after {
    width: 6%;
} 
.btn{
    display:grid;
    grid-template-columns:110% 80%;
    background:whitesmoke; 
    margin-top:10px;
    
    
}
input[type="submit"] {
   
   background:blue;
   border:1px solid white;
   border-radius:3px;
   text-align:center;
   padding:5px;
   margin:5px;

}

/* .viewdetails{
  height:30px;
  width:65px;
  margin-left:110px;
  margin-top:-20px;
  color:white;

} */
.viewdetails{
   /* background-color:green; */
   color:white;
   text-align:center;
 
}
.viewdetails1{
   /* background-color:green; */
   color:white;
   text-align:center;
   font-size:100px;
 
}

</style>
</head>
<body style="background:">
  
</body>
</html>
  
      
    </div>
    
  <div class="col-md-6">
    
      <img src="" class="img-fluid">
 
  </div>

  </div>
</div>
</div>

<!--banner end-->


<!---top sell start---->

<section>
  <div class="container">
    <div class="topsell-head">
      <div class="row">
         <div class="col-md-12 text-center">
        
           <h4>All Products</h4> 


        </div>
        
        
      </div>

    </div>
  </div>
  <div class="container" style="margin-left:200px;">
  <div class="row">
  <?php
          if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
              $product_name=$row['name'];
              ?>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="card">
              <div class="image">
                <img src="<?php echo $row['imgname']; ?>">
              </div>
              <div>
              <div class="caption">
                <h6><?php echo $row["name"] ?></h6> 
                <span style="color:red; font-weight:450;"><?php echo "Rs.".$row["Price"] ?></span> 
                <input  class="viewdetails1"type="hidden" name="product_id" value="<?php echo $row['id']; ?>"> 
                <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $row['Price']; ?>">
                <input  type="hidden" name="imgname" value="<?php echo $row['imgname']; ?>">
                <input type="hidden" name="product_quantity" value="<?php echo $row['quantity']; ?>">

              
              </div>
              <div class="lowbtns" style="text-align:center;">
              <input type="submit"  class="viewdetails" value="Add to cart" name="add_to_cart">
              <input type="submit" class="viewdetails"  value="Details" name="Details" >
              </div>
            </div>
             
            </div>
            </form>
            <?php 
            }
    }
        
        else 
            echo "0 results";
        ?>

            
          </div>
  </div>
</section>
<?php
 
?>
<script>  
   function redirectToCart(productId){
    window.location.href="Details.php";
   }
</script>
















