<?php
SESSION_START();
 include'adminbar.php';
 
$price=1200;
include 'connection.php';
if(!isset($_SESSION['loggedin'])|| $_SESSION['loggedin']!==true){
  header("Location:loginpage.html");
 }
 if(isset($_POST['filter_date'])){
  $date=$_POST['date'];
  // $enddate=$_POST['end_date'];
  $sql9 = "SELECT * FROM cricsalbooking WHERE bookday='$date' ";
  $result = $conn -> query ($sql9);


}
else{
  $sql = "SELECT * FROM cricsalbooking ORDER BY bookday DESC";
  $result = $conn -> query ($sql);
} 

if(isset($_POST['submit'])){
  $id=$_POST['id'];
  $shift=$_POST['shift'];
  $sql2="DELETE  FROM cricsalbooking WHERE id='$id' and shift='$shift' ORDER BY bookday DESC;";
  $result2=mysqli_query($conn,$sql2);
  if ($result2) {
   $deletedRows = mysqli_affected_rows($conn);
  if($deletedRows>0){
   echo "<script>alert('Booking is removed now'); window.location.reload();</script>";
  }
  
}
}
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
    <h1>Admin Cricsal</h1><br>
    <h4 style="margin-left:100px;"><form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="date">Book Date  Date:</label>
        <input type="date" name="date"  required>
        <!-- <label for="end_date">End Date:</label>
        <input type="date" name="end_date" required> -->
        <input type="submit" name="filter_date">
    </form></h4>
    <hr class="line">
</div>
<div class="container pendingbody">
<table class="table">
  <thead>
    <tr>
    <th scope="col">Booked Date</th>
      <th scope="col">User</th>
      <th scope="col">Bookday</th>
      <th scope="col">Shift</th>
      <th scope="col">Contact</th>
      <th scope="col">Price</th>
      <th scope="col">Remove</th>
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
      <td><?php echo $row["user"] ?></td>
      <td><?php echo $row["bookday"] ?></td>
      <td><?php echo $row["shift"] ?></td>
      <td><?php echo $row["contact"] ?></td>
      <td><?php echo $row["Price"] ?></td>
      <td><form method='POST' action="<?php echo $_SERVER['PHP_SELF'] ; ?>"> 
        <input type="hidden" name="id" value="<?php echo $row['id']?>">
        <input type="hidden" name="shift" value="<?php echo $row['shift']?>">
        
        <button type="submit" name="submit">Remove</button>

    </form></td>
     
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