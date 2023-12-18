<?php 
session_start();
$contact=$_SESSION['contact'];

if (isset($_POST['proceed'])) {
  $connect = mysqli_connect("localhost", "root", "") or die("Unable to connect to MySQL Sever.");
  require 'config.php';
 if (isset($_SESSION['user'])) {
   $user = $_SESSION['user'];
   $bookday = $_POST['bookdate'];
   $shift = $_POST['shift'];
   $cricsalprice=$_POST['cricsalprice'];

   $t = time() + 13500;
   $details = "SELECT ContactNumber,FirstName from registeruser WHERE Username='" . $user . "'";
   $test = $connect->query($details);
   $details = $test->fetch_assoc();
//    $user = $details['fname'];


   if ($shift == "6-7")
     $hr = 6 * 3600;
   else if ($shift == "7-8")
     $hr = 7 * 3600;
   else if ($shift == "8-9")
     $hr = 8 * 3600;
   else if ($shift == "10-11")
     $hr = 10 * 3600;
   else if ($shift == "12-13")
     $hr = 12 * 3600;
   else if ($shift == "14-15")
     $hr = 14 * 3600;
   else if ($shift == "16-17")
     $hr = 16 * 3600;
   else if ($shift == "17-18")
     $hr = 17 * 3600;
   else if ($shift == "18-19")
     $hr = 18 * 3600;
   else
     $hr = 19 * 3600;
   $timestamp = strtotime($bookday);
   $timestamp += $hr;


   if ($timestamp < $t) {
     $msg = 'Expired Time value selected!!\n\n Boooked Time : ' . date("H:i:s", $timestamp) . '\n Current Time : ' . date("Y/m/d @ H:i:s", $t);
     echo '<SCRIPT language = "javascript">
                   alert(" Booking Failed !!!\n ' . $msg . '");
                   window.location.replace("Cricsalbooking.php");
                   </SCRIPT>';
   } else {

     $msg = 'Booked Successfully!!\n Boooked Date & Time : ' . date("Y/m/d @ H:i:s", $timestamp);
     echo '<SCRIPT language = "javascript">
                   alert("' . $msg . '");
                   window.location.replace("Cricsalbooking.php");
                   </SCRIPT>';
     $connect->query(
       "INSERT INTO `cricsalbooking` (`id`, `user`, `bookday`, `shift`, `contact`, `email`, `timecheck`, `confirm_key`,`Price`)                  VALUES                (NULL,'$user','$bookday', '$shift','$contact', '$email', '$t','11','$cricsalprice');"
     );


       $connect->close();
     }
   } else {
     header("location:loginpage.php");
   }
 }
 ?>
