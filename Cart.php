<?php
ob_start();
session_start();
error_reporting(E_ALL);
$todaydate=date("Y-m-d");
$flag="";
ini_set('display_errors', 1);
 include 'Finalheader.php';
 include 'connection.php';
 if(!isset($_SESSION['loggedin'])|| $_SESSION['loggedin']!==true){
    header("Location:loginpage.html");
   }
   $mobnumber = $_SESSION['contact'];
  
 
   $user_address =$_SESSION['address'];
 

 
      
  
if(isset($_POST['order_btn'])){
  
  $userid = $_POST['user_id'];
  $name = $_POST['user_name'];
  // $number =1;  
  $user_address=$_SESSION['address'];
 
  $mobnumber = $_POST['mobnumber'];
  
  
  
  $product_name = [];
  $txid = mt_rand(10000, 99999);
  /*$price_total = $_POST['total'];*/
  $status="To be defined";

  $cart_query = mysqli_query($conn, "SELECT * FROM `cart` where userid='$userid'");

  $price_total = 0;
  if(mysqli_num_rows($cart_query) > 0){
     while($product_item = mysqli_fetch_assoc($cart_query)){
        $product_name[] = $product_item['name'] .' ('. $product_item['quantity'] .') ';
        $product_price = $product_item['price'] * $product_item['quantity'];

        $price_total += $product_price;
        $sql = "SELECT * FROM product ";
        $result = $conn -> query ($sql);
      
        if (mysqli_num_rows($result) > 0) {
          // output data of each row
          while($row = mysqli_fetch_assoc($result)) {
            if($row['id']===$product_item['productid'])
            {
              if($product_item['quantity']<=$row['quantity'])
              {
                $update_id=$row['id'];
                $t=$row['quantity']-$product_item['quantity'];
                $update_quantity_query = mysqli_query($conn, "UPDATE `product` SET quantity = '$t' WHERE id = '$update_id'");
                

                $flag=1;


                

              }
              else
              {
                echo "<script>alert(\"out of stock\")</script>"; 

              }
            }
            
          }

        }

     };
     if($flag==1)
     {

      $total_product = implode(', ', $product_name);
       echo $total_product;
       $detail_query = mysqli_query($conn, "INSERT INTO `orders`(userid, name, address, phone,  mobnumber, txid, totalproduct, totalprice, status)
        VALUES('$userid','$name','$user_address','$mobnumber','$mobnumber','$txid','$total_product','$price_total','$status')") or die($conn -> error);
           
             $cart_query1 = mysqli_query($conn, "delete FROM `cart` where userid='$userid'");
             header("location:Cart.php");

     }
  };



}

$id=$_SESSION['user'];
 $sql = "SELECT * FROM cart where userid='$id'";
 $result = $conn -> query ($sql);

 if(isset($_POST['update_update_btn'])){
  $update_value = $_POST['update_quantity'];
  $update_id = $_POST['update_quantity_id'];
  $update_name = $_POST['update_quantity_name'];
  // *********
  $sql3= "SELECT * FROM product WHERE name='$update_name'";
  $result3 = $conn -> query ($sql3);
  if (mysqli_num_rows($result3) > 0) {
    // output data of each row
    while($row3 = mysqli_fetch_assoc($result3)) {
     $dbquantity=$row3['quantity'];
     
    }}
    if($dbquantity>$update_value){   
      $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_id'");
      if($update_quantity_query){
          header('location:cart.php');
      }; }
    else{
       echo '<script>alert("Stock Not Available")</script>';
    }
};

if(isset($_GET['remove'])){
  $remove_id = $_GET['remove'];
  mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'");
  header('location:cart.php');
};


?>
<style>

.table {
  margin-top: 10px; /* Increase space between textfield area and table */
}
tr
  {
    align-items:center;
    text-align: center;
    justify-content:center;
    gap:2em;
    margin-bottom:10px;
    white-space: nowrap;

    /* margin:3%; */
  }
  th
  {
    padding:25px 25px;
    white-space: nowrap;
    text-align: center;
    background-color: #e6f5ff;

  }
  td 
  {
    padding: 8px 10px;
    background-color: #FFEAEE;
    color:black;
    
  }

  .footer {
    background-color: gray;
    /* color:  #FFC000; */
    color:  white;
    text-align: center;
    padding: 10px 0;
    position: fixed;
    bottom: 0;
    width: 100%;
    opacity: 0; /* Initially hidden */
    transition: opacity 0.3s ease; /* Smooth transition */
    display: flex;
    justify-content: center;
    align-items: center;
    height: 30px; /* Adjust the height as needed */
    /* margin-left:-16%; */
    
}

/* Style for the copyright text */
.copyright {
    font-size: 14px;
    margin: 0; /* Remove default margin */
}

  </style>

<div class="container pendingbody">
  <h5><b>CART</b></h5>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Quantity</th>
      <th scope="col">Price</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $total=0;
          if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
              ?>
    <tr>
      <th scope="row">1</th>
      <td><?php echo $row["name"] ?></td>
  
      <td><form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <input type="hidden" name="update_quantity_name"  value="<?php echo  $row['name']; ?>" >
        <input type="hidden" name="update_quantity_id"  value="<?php echo  $row['id']; ?>" >
        <input type="number" name="update_quantity" min="1"  value="<?php echo $row['quantity']; ?>" >
        <input type="submit" value="update" name="update_update_btn">
       
      </form></td> 
      <td><?php echo $row["price"]*$row["quantity"]  ?></td>
      <?php $total=$total+$row["price"]*$row["quantity"] ;?>
     

      <input type="hidden" name="status" value="pending">   
      <td><a href="cart.php?remove=<?php echo $row['id']; ?>">remove</a></td>
    </tr>
    <?php 
    }
    // echo "total=" . $row['quantity'];
        } 
        else 
            echo "0 results";
        ?>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

        <!-- <h5>if Cash On delivary Then Put 0 in bkash Field</h5> -->
      <div class="input-group form-group">
      <input type="hidden" name="total" value="<?php echo $total ?>">
      <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']; ?>">
      <input type="hidden" name="user_name" value="<?php echo $_SESSION['user']; ?>">
      <input type="hidden" name="mobnumber" value="<?php echo $mobnumber; ?>">
      <input type="hidden" name="user_address" value="<?php echo $user_address; ?>"> 


        <!-- <input type="text" class="form-control" placeholder="Address" name="address">
       </div>
       <div class="input-group form-group">
        <input type="number" class="form-control" placeholder="Phone Number" name="number">
       </div>
       <div class="input-group form-group">
        <input type="number" class="form-control" placeholder="Bkash/Nogod/Rocket Number" name="mobnumber">
       </div>
       <div class="input-group form-group">
        <input type="text" class="form-control" placeholder="Txid" name="txid">
       </div> -->

      <div class="form-group" style=" margin-left:1000px;">
      <input type="submit" value="Order Now" name="order_btn">
    </div>

    </form>
  </tbody>
</table>
</div>

<script>
    window.addEventListener('scroll', function() {
        var footer = document.querySelector('.footer');
        var scrollY = window.scrollY || window.pageYOffset;
        var pageHeight = document.documentElement.scrollHeight || document.body.scrollHeight;
        var viewportHeight = window.innerHeight || document.documentElement.clientHeight;

        if (scrollY + viewportHeight >= pageHeight - 10) {
            footer.style.opacity = '1';
        } else {
            footer.style.opacity = '0';
        }
    });
</script>
<div class="footer">
    		<p class="copyright">&copy; 2023 <a style="text-decoration:none; color:white;" href="home.php">Velocity Arena</a></p>
</div>
    
  
  <?php 
ob_end_flush();