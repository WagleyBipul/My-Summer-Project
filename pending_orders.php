<?php
SESSION_START();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
ob_start(); 
 include'adminbar.php';
 
 if(!isset($_SESSION['loggedin'])|| $_SESSION['loggedin']!==true){
  header("Location:loginpage.html");
 }

include 'connection.php';
$sql = "SELECT * FROM orders where status='pending'";
$result = $conn -> query ($sql);

if(isset($_POST['update_update_btn'])){
  $update_value = $_POST['update_status'];
  $update_id = $_POST['update_id'];
  $update_quantity_query = mysqli_query($conn, "UPDATE `orders` SET status = '$update_value' WHERE id = '$update_id'");
  if($update_quantity_query){
     header('location:pending_orders.php');
  };
};

if(isset($_GET['remove'])){
  $remove_id = $_GET['remove'];
  mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$remove_id'");
  header('location:pending_orders.php');
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/pending_orders.css">

</head>
<style>
body
{
  margin-left:14%;
  margin-top:7%;
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
    background-color:lightgreen;
    color:black;

    
  }

</style>
<body>
<div class="c1">
          <h1>Pending Orders</h1>
          <hr class="line">
        </div>
<div class="container pendingbody">
<table class="table" style="font-weight:bold;">
  <thead>
    <tr>
    <th scope="col">Ordered Date</th>
      <th scope="col">Name</th>
      <th scope="col">Address</th>
      <th scope="col">Phone</th>
      <th scope="col">Send Money Number</th>
      <th scope="col">Txid</th>
      <th scope="col">Total Product</th>
      <th scope="col">Total Price</th>
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
       <td><?php
       $time=$row["created_at"];
       $shortime =substr($time, 0, 16);
       echo $shortime;
       
       
       
       ?></td>
      <td><?php echo $row["name"] ?></td>
      <td><?php echo $row["address"] ?></td>
      <td><?php echo $row["phone"] ?></td>
      <td><?php echo $row["mobnumber"] ?></td>
      <td><?php echo $row["txid"] ?></td>
      <td><?php echo $row["totalproduct"] ?></td>
      <td><?php echo $row["totalprice"] ?></td>
      <td><form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="hidden" name="update_id"  value="<?php echo  $row['id']; ?>" >
        <div>
                                <select name="update_status" class="form-control">
                                <option><?php echo $row['status']; ?></option>
                                    <option value="Pending">Pending</option>
                                    <option value="Confirmed">Confirmed</option>
                                  <option value="Cancel">Cancel</option>
                                  <option value="Delivered">Delivered</option>
                                </select>
                            </div>
        <input type="submit" value="update" name="update_update_btn">
      </form></td>
      <td><a href="pending_orders.php?remove=<?php echo $row['id']; ?>">remove</a></td>
    </tr>
    <?php 
    }
        } 
        else 
            echo "0 results";
        ?>
        
  </tbody>
</table>
</div>
<br><br><br><br>
    
</body>
 <?php  ob_end_flush(); ?>
</html> 