<?php
SESSION_START();
ob_start(); 
 include'adminbar.php';
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;
 
 if(!isset($_SESSION['loggedin'])|| $_SESSION['loggedin']!==true){
  header("Location:loginpage.html");
 }
 else{
  $usercontact=$_SESSION['contact'];
 }

 $duu="SELECT * FROM registeruser WHERE ContactNumber='$usercontact'";
 $resu=$conn-> query($duu);
 

  while ($rr = mysqli_fetch_assoc($resu)) {
      $email = $rr['Email'];
      // Process or use the $email variable here
    
  }




include 'connection.php';
$sql = "SELECT * FROM orders ORDER BY created_at DESC";
$result = $conn -> query ($sql);

if(isset($_POST['update_update_btn'])){
  $update_value = $_POST['update_status'];
  $update_id = $_POST['update_id'];
  $update_quantity_query = mysqli_query($conn, "UPDATE `orders` SET status = '$update_value' WHERE id = '$update_id'");
  
  if($update_value=="Confirmed"){
       
       $update_id=$_POST['update_id'];
       $name=$_POST['name'];
       $address=$_POST['address'];
       $mobnumber=$_POST['mobnumber'];
       $totalproduct=$_POST['totalproduct'];
       $totalprice=$_POST['totalprice'];
       $status="Confirmed";

  
      require 'PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
  require 'PHPMailer-master/PHPMailer-master/src/SMTP.php';
  require 'PHPMailer-master/PHPMailer-master/src/Exception.php';
  
  
  
  
    // Retrieve client phone number based on order ID
   
    $clientPhone =$number;
  
    // Retrieve client email based on phone number
    
    $clientEmail ="waglebipul02@gmail.com";
    
    {
        // Send email notification to the client using PHPMailer
        $mail = new PHPMailer(true);
  
  
          try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP(true);  // Set to true
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'waglebipul02@gmail.com'; // Replace with your email
            $mail->Password   = 'ndwjnlnaqahogytk'; // Replace with your email password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
  
            //Recipient
            $mail->setFrom('waglebipul02@gmail.com', 'Admin@velocityarena.com');// Replace with your email and name
            $mail->addAddress($clientEmail); // Add a recipient
  
  
            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'Greetings , From velocity Arena !!';
            $mail->Body    = 'Your order has been confirmed as following : <br> '.'Name-> '.$name.'<br>Address ->'.$address.'<br>Phone Number->'.$mobnumber.'<br> Product Detail ->'.$totalproduct.'<br> Total Price ->'.$totalprice .'<br> Status is '.$status ;
            $mail->SMTPOptions = [
              'ssl' => [
                  'verify_peer' => false,
                  'verify_peer_name' => false,
                  'allow_self_signed' => true,
              ],
          ];
                 $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
  
        if ($mail->send()) {
          echo 'Message has been sent';
      } else {
          echo 'Message could not be sent.';
          echo 'Mailer Error: ' . $mail->ErrorInfo;
      }
  
        header('location:Orderstatus.php');
        exit();
    
  }
  
  }
  
     header('location:Orderstatus.php');
  
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
  background:white;
}
.c1 h1
  {
    /* margin-bottom:2%; */
    /* margin-top:%; */
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
  margin-top: 10px;
  width:80%;
  white-space:no-wrap;
   /* Increase space between textfield area and table */
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
    background-color:green;
    color:white;
    text:nowrap;
    

  }
  td 
  {
    padding: 8px 10px;
    background-color:white;
    color:black;
    font-size:10px;
    
  }

  body {
    margin-left: 14%;
    margin-top: 7%;
  }

  .c1 h1 {
    margin-top: 7%;
  }

  .line {
    height: 1px;
    max-width: 220px;
    color: grey;
    opacity: 20%;
    margin-top: 0%;
    margin-bottom: 3%;
  }

  label {
    font-size: 1.3em;
    margin-bottom: 15px;
  }

  h2 {
    margin-top: 25px;
    margin-bottom: 15px;
  }

  .table {
    margin-top: 10px;
    margin-left:-15px;
    width: 100%; /* Set width to 100% to make it responsive */
  }

  tr {
    align-items: center;
    text-align: center;
    justify-content: center;
    gap: 2em;
    margin-bottom: 10px;
    white-space: nowrap;
  }

  th {
    padding: 15px 10px; /* Adjust padding */
    background-color: green;
    color: white;
    font
  }

  td {
    padding: 5px 10px; /* Adjust padding */
    background-color:lightgreen;
    color: black;
    font-size: 14px;
    font-weight:400;
    width:500px; 
    white-space: normal;/* Adjust font size */
  }
  table, th{
    border: 1px solid lightgreen;
}
</style>
<body>
<div class="c1">
          <h1>Order Status</h1>
          <hr class="line">
        </div>
<div class="container pendingbody">
<table class="table" style="font-weight:bold; ">
  <thead>
    <tr>
    <th scope="col">Ordered Date</th>
      <th scope="col">Name</th>
      <th scope="col">Address</th>
      <th scope="col">Phone</th>

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
    <tr><td></td></tr>
    <td><?php
       $time=$row["created_at"];
       $shortime =substr($time, 0, 16);
       echo $shortime;
       
       
       
       ?></td>
      <td><?php echo $row["name"] ?></td>
      <td><?php echo $row["address"] ?></td>
      <td><?php echo $row["mobnumber"] ?></td>
  
      <td><?php echo $row["txid"] ?></td>
      <td><?php echo $row["totalproduct"] ?></td>
      <td><?php echo $row["totalprice"] ?></td>
      <td><form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="hidden" name="update_id"  value="<?php echo  $row['id']; ?>" >
        <input type="hidden" name="name"  value="<?php echo  $row['name']; ?>" >
        <input type="hidden" name="address"  value="<?php echo  $row['address']; ?>" >
        <input type="hidden" name="mobnumber"  value="<?php echo  $row['mobnumber']; ?>" >
        <input type="hidden" name="totalproduct"  value="<?php echo  $row['totalproduct']; ?>" >
        <input type="hidden" name="totalprice"  value="<?php echo  $row['totalprice']; ?>" >
        <input type="hidden" name="status"  value="<?php echo  $row['status']; ?>" >
        <div>
                                <select name="update_status" class="form-control">
                                <option><?php echo $row['status']; ?></option>
                                <option value="Pending">To be defined</option>
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