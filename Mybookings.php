<?php
 include'Finalheader.php';
 include 'connection.php';
 SESSION_START();
 $user=$_SESSION['user'];

 if(!isset($_SESSION['loggedin'])|| $_SESSION['loggedin']!==true){
  header("Location:loginpage.html");
 }

 $sssql = "SELECT Price FROM prices";
 $rrresult=$conn->query($sssql);
if($rrresult->num_rows >0){
  $row=$rrresult->fetch_assoc();
  $price=$row['Price'];
}
$sssql = "SELECT Price FROM cricsalprices";
$rrresult=$conn->query($sssql);
if($rrresult->num_rows >0){
 $row=$rrresult->fetch_assoc();
 $cricsalprice=$row['Price'];
}
//  var_dump($user);
$aajakodin = date('Y-m-d'); 
$limitday= date('y-m-d',strtotime($aajakodin. '-7 day'));

// $sql = "SELECT * FROM cricsalbooking";
$sql2 = "SELECT * FROM cricsalbooking WHERE bookday > '$limitday'AND user='$user'";

$result = $conn -> query ($sql2);
$query = "SELECT * FROM booking WHERE bookday > '$limitday' AND user='$user' ";
$result2 = $conn -> query ($query);




if(isset($_POST['submit'])){
  $id=$_POST['id'];
  $shift=$_POST['shift'];
  $bookeddate=$_POST['bookday'];
  $today = date('Y-m-d');  // Current date
  $oneDayAfter = date('Y-m-d', strtotime($today . ' +2 day'));
  
echo $oneDayAfter;
echo $bookeddate;
  
     if($oneDayAfter<$bookeddate){
       
    $sql2="DELETE  FROM cricsalbooking WHERE id='$id' and shift='$shift';";
    $result2=mysqli_query($conn,$sql2);
  if ($result2) {
     
       $deletedRows = mysqli_affected_rows($conn);
  if($deletedRows>0){
      echo "<script>alert('Booking is removed now'); window.location.reload();</script>";
  }
  }
  }
else{
  echo "<script>alert('Booking cannot be deleted prior to the date '); </script>";
}



}
if(isset($_POST['submit2'])){
  $id2=$_POST['id2'];
  $shift2=$_POST['shift2'];
  $bookeddate2=$_POST['bookday2'];
  $today2 = date('Y-m-d');  // Current date
  $oneDayAfter2 = date('Y-m-d', strtotime($today2 . ' +2 day'));
echo $oneDayAfter2;
echo $bookeddate2;
  
     if($oneDayAfter2<$bookeddate2){
     
    $sql2="DELETE  FROM booking WHERE id='$id2' and shift='$shift2';";
    $result2=mysqli_query($conn,$sql2);
  if ($result2) {
   
       $deletedRows2 = mysqli_affected_rows($conn);
  if($deletedRows2>0){
      echo "<script>alert('Booking is removed now'); </script>";
      sleep(1);
      header("Location:Mybookings.php");
  }
  }
  }
else{
  echo "<script>alert('Booking cannot be deleted prior to the date '); </script>";
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
<body style=" background:Whitesmoke;">

<div class="container pendingbody">
  <h5>Cricsal</h5>
<table class="table">
  <thead>
    <tr>

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
      
      <td><?php echo $row["user"] ?></td>
      <td><?php echo $row["bookday"] ?></td>
      <td><?php echo $row["shift"] ?></td>
      <td><?php echo $row["contact"] ?></td>
      <td><?php echo $row["Price"] ?></td>
      <td><form method='POST' action="<?php echo $_SERVER['PHP_SELF'] ; ?>"> 
        <input type="hidden" name="id" value="<?php echo $row['id']?>">
        <input type="hidden" name="shift" value="<?php echo $row['shift']?>">
        <input type="hidden" name="bookday" value="<?php echo $row['bookday']?>">
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
<div class="container pendingbody">
  <h5>Futsal</h5>
<table class="table">
  <thead>
    <tr>

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
          if (mysqli_num_rows($result2) > 0) {
            // output data of each row
            while($row2= mysqli_fetch_assoc($result2)) {
              ?>
    <tr>

      <td><?php echo $row2["user"] ?></td>
      <td><?php echo $row2["bookday"] ?></td>
      <td><?php echo $row2["shift"] ?></td>
      <td><?php echo $row2["contact"] ?></td>
      <td><?php echo $row2["Price"] ?></td>
      <td><form method='POST' action="<?php echo $_SERVER['PHP_SELF'] ; ?>"> 
        <input type="hidden" name="id2" value="<?php echo $row2['id']?>">
        <input type="hidden" name="shift2" value="<?php echo $row2['shift']?>">
        <input type="hidden" name="bookday2" value="<?php echo $row2['bookday']?>">
        <button type="submit" name="submit2">Remove</button>

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
    
</body>
</html>
