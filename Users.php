<?php
 SESSION_START();
 ob_start();
 include'adminbar.php';
 if(!isset($_SESSION['loggedin'])|| $_SESSION['loggedin']!==true){
  header("Location:loginpage.html");
 }

$price=1000;
include 'connection.php';
$sql = "SELECT * FROM registeruser";
$result = $conn -> query ($sql);
  if(isset($_GET['remove'])){
   $remove_user=$_GET['remove'];
    mysqli_query($conn, "DELETE FROM `registeruser` WHERE Username='$remove_user' ");
sleep(2);
header("Location:Users.php");
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
    background-color: #e6f5ff;

  }
  td 
  {
    padding: 8px 10px;
    background-color: #FFEAEE;
    color:black;
    
  }

</style>
<body>

<div class="container pendingbody">
  <h5>All Orders</h5>
<table class="table">
  <thead>
    <tr>

      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Email</th>
      <th scope="col">Contact Number</th>
      <th scope="col">Address</th>
      <th scope="col">Username</th>
      <th scope="col">Password</th>
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

      <td><?php echo $row["FirstName"] ?></td>
      <td><?php echo $row["LastName"] ?></td>
      <td><?php echo $row["Email"] ?></td>
      <td><?php echo $row["ContactNumber"] ?></td>
      <td><?php echo $row["Address"] ?></td>
      <td><?php echo $row["Username"] ?></td>
      <td><?php echo $row["Password"] ?></td>
      <td><a href="Users.php?remove=<?php echo $row['Username'] ?>">remove</td>
     
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
<br><br><br><br><br><br><br><br><br>
</body>
<?php  ob_end_flush(); ?>
</html>