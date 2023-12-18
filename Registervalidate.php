<?php  
require 'config.php';
$fname=$username=$lname=$address=$email=$contact=$password=$test=$allUsers="";
if (isset($_POST['btnSubmit'])) {
  $connect = mysqli_connect("localhost","root","") or die ("Unable to connect to MySQL Sever.");
  require 'config.php';
  var_dump($connect);

  $fname = $_POST['firstname'];
  $username=$_POST['username'];
  $lname = $_POST['lastname'];
  $address=$_POST['address'];
//   $gender = $_POST['gender'];
  //$address=$_POST['address']; 
  $email = $_POST['email'];
  $contact = $_POST['contact'];
  $password = $_POST['password'];
  $remember="Hello";
//   $cpassword = $_POST['cpassword'];
  $test = "SELECT * FROM registeruser";
  $allUsers = $connect->query($test);
  $eflag = 0;
  $uflag = 0;
  while ($test = $allUsers->fetch_assoc()) {
    if ($test['Email'] == $_POST['email']) $eflag = 1;
    if($test['Username'] == $_POST['username']) $uflag=1;
  }
  if ($eflag || $uflag) {
     if($eflag)
     {
        header("Location:loginpage.html");
        echo '<script language="javascript">';
        echo 'alert("Email Already exists!!")';
        echo '</script>';
     }
     elseif($uflag){
        header("Location:loginpage.html");
        echo '<script language="javascript">';
        echo 'alert("Username Already exists!!")';
        echo '</script>';
     }
  }
  
  
  else {
    
    $sqli="INSERT INTO registeruser(`id`, `FirstName`, `LastName`, `Email`, `ContactNumber`, `Address`, `Username`, `Password`, `remember_token`) 
VALUES (NULL, '$fname', '$lname', '$email', '$contact', '$address', '$username', '$password', '$remember')";

    // session_start();
    // $_SESSION['email'] = $email;
    // $_SESSION['pwd']   = $password;
    // $_SESSION['user']  = $fname;
    var_dump($connect);

   
    echo '<script language="javascript">';
    echo 'alert("User Registered Successfully!")';
    echo '</script>';
    // header("Location:loginpage.html");
    // header("Location:login.html");
  }
  $connect->close();  // close Connection

}
?>