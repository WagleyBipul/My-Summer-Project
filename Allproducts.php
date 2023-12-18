<?php
SESSION_START();
ob_start();


 include 'adminbar.php';
 include 'connection.php';
 if(!isset($_SESSION['loggedin'])|| $_SESSION['loggedin']!==true){
  header("Location:loginpage.html");
 }

 $sql = "SELECT * FROM product";
 $result = $conn -> query ($sql);
  if(isset($_POST['updatefutsal'])){
    // $msql="SELECT Price FROM price";
    // $mresult=$conn->query($msql);
    $futsalprice=$_POST['futsalprice'];
    $update_futsalprice = mysqli_query($conn, "UPDATE `prices` SET `Sport`='Futsal',`Price`='$futsalprice' WHERE 1");
  


  echo "Futsal Price Updated";
 }
 if(isset($_POST['updatecricsal'])){
  // $msql="SELECT Price FROM prices";
  //   $mresult=$conn->query($msql);
    $cricsalprice=$_POST['cricsalprice'];
    $update_cricsalprice = mysqli_query($conn, "UPDATE `cricsalprices` SET `Sport`='Cricsal',`Price`='$cricsalprice' WHERE 1");

  echo "Cricsal Price Updated";
 }
 

 if(isset($_POST['update_update_btn'])){
  $name = $_POST['update_name'];
  $catagory = $_POST['update_catagory'];
  $quantity = $_POST['update_quantity'];
  $price = $_POST['update_Price'];
  $update_id = $_POST['update_id'];
  $update_quantity_query = mysqli_query($conn, "UPDATE `product` SET quantity = '$quantity' , name='$name' , catagory='$catagory' ,price='$price'  WHERE id = '$update_id'");
  if($update_quantity_query){
     header('location:Allproducts.php');
  };
};

 if(isset($_GET['remove'])){
  $remove_id = $_GET['remove'];
  mysqli_query($conn, "DELETE FROM `product` WHERE id = '$remove_id'");
  header('location:Allproducts.php');
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="css/pending_orders.css"> -->
<style> 
body
{
  margin-left:14%;
  margin-top:4%;

}
.pricecricsal{
  margin-left:100px;
  font-weight:bold;
}
.pricefutsal{
  font-weight:bold;
}
.c1 h1
  {
    /* margin-bottom:2%; */
    margin-top:7%;
  }
  .line
        {
            height: 1px;
            max-width:220px;
            color: grey;
            opacity: 20%;
            margin-top: 0%;
            margin-bottom:3%;
            /* margin-left:14%;  */
        }
  label 
  {
    font-size:1.3em;
    margin-bottom:15px;
  }
  h2 
  {
    margin-top:25px;
    margin-bottom:15px;
  }
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
    background-color: Green;
    color:white;

  }
  td 
  {
    padding: 8px 10px;
    background-color: lightgreen;
    color:black;
    
  }
  input[type="text"],input[type="number"] 
        {
            width: 15%;
            height:30px;
        }
.table input[type="text"],
.table input[type="number"] {
  width: 80%;
  height: 30px;
  text-align: center;
}


</style>
</head>
<body>
<div class="c1">
    <h1>All Product</h1>
    <hr class="line">
</div>
<div class="container-pendingbody">

      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

      <label for="futsalprice" class="pricefutsal">Futsal Price</label>
      <input type="Number" name="futsalprice" class="futsal" id="futsal">
      <input type="submit" class = "btnss" value="Update Futsal" name="updatefutsal">
      <label for="cricsalprice" class="pricecricsal">Cricsal Price</label>
      <input type="Number" name="cricsalprice" class="cricsalprice" id="cricsalprice">
      <input type="submit" class = "btnss" value="Update cricsal" name="updatecricsal">

      </form>
  <h2>All Product</h2>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Image</th>
      <th scope="col">Name</th>
      <th scope="col">Catagory</th>
      <th scope="col">Quantity</th>
      <th scope="col">Price</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
          if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
              ?>
    <tr>
      <td><img src="photoes/<?php echo $row['imgname']; ?>" style="width:50px;"></td>
     <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="hidden" name="update_id"  value="<?php echo  $row['id']; ?>" >
        <td><input type="text" name="update_name"  value="<?php echo $row['name']; ?>" ></td>
        <td><input type="text" name="update_catagory"  value="<?php echo $row['catagory']; ?>" ></td>

        <td><input type="number" name="update_quantity"  value="<?php echo $row['quantity']; ?>" ></td>
        <td> <input type="number" name="update_Price" value="<?php echo $row['Price']; ?>" ></td>
        <td> <input type="submit" value="update" name="update_update_btn">
      </form></td>
      <td><a href="Allproducts.php?remove=<?php echo $row['id']; ?>">remove</a></td>
    </tr>
    <?php 
    }
        } 
        else 
            echo "0 results";
        ?>
  </tbody>
</table>

<br><br><br>

</div>
    
</body>
 <?php  ob_end_flush(); ?>
</html>