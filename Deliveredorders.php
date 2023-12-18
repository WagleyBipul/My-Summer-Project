<?php

 SESSION_START();
 include'adminbar.php';

include 'connection.php';
$sql = "SELECT * FROM orders where status='delivered'";
$result = $conn -> query ($sql);
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
  body{
    margin-left:14%;
    margin-top:7%;
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
  .c1 h1
  {
    margin-bottom:2%;
    margin-top:0%;
  }
  .line
        {
            height: 1px;
            max-width:220px;
            color: grey;
            opacity: 20%;
            margin-top: -2%;
            margin-bottom:3%;
            /* margin-left:14%;  */
        }
</style>
<body>
<div class="c1">
          <h1>Delivered Orders</h1>
          <hr class="line">
        </div>
<div class="container pendingbody">
<table class="table">
  <thead>
    <tr>

      <th scope="col">Name</th>
      <th scope="col">Address</th>
      <th scope="col">Phone</th>
      <th scope="col">Send Money Number</th>
      <th scope="col">Txid</th>
      <th scope="col">Total Product</th>
      <th scope="col">Total Price</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
  <?php
          if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
              ?>
    <tr>

      <td><?php echo $row["name"] ?></td>
      <td><?php echo $row["address"] ?></td>
      <td><?php echo $row["phone"] ?></td>
      <td><?php echo $row["mobnumber"] ?></td>
      <td><?php echo $row["txid"] ?></td>
      <td><?php echo $row["totalproduct"] ?></td>
      <td><?php echo $row["totalprice"] ?></td>
      <td><?php echo $row["status"] ?></td>
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
    
</body>
</html>