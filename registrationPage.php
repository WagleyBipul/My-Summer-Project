<?php
 require 'connection.php';
 $firstnameErr = $lastnameErr =$confirmpasswordErr= $emailErr = $contactErr = $usernameErr = $passwordErr = $addressErr = " ";
 $fname=$lname=$email=$contact=$address=$username=$password=$confirmpassword=" ";

require 'config.php';
$connect = mysqli_connect("localhost","root","") or die ("Unable to connect to MySQL Sever.");
mysqli_select_db($connect, "finalcode");
 
  if(isset($_POST['btnsubmit'])){
    $fname=$_POST['firstname'];
    $lname = $_POST['lastname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address= $_POST['address'];
    $username=$_POST['username'];
    $password = $_POST['password'];
    $remember=uniqid("Velocity-");
    $confirmpassword =$_POST['confirmpassword'];
    if(empty($_POST['firstname'])){
        $firstnameErr="Please enter firstname ";
    }
    elseif(preg_match('/[a-zA-Z]+$/u', $fname)) 
     {
        $fname=$_POST['firstname'];
        $firstnameErr="";
     }
     else {
      $firstnameErr="Please enter only alphabets !";
    }
     if(empty($_POST['lastname'])){
      $lastnameErr="Please enter lastname";
     }
     elseif(preg_match('/[a-zA-Z]+$/u', $lname)) {
      $lname = $_POST['lastname'];
      $lastnameErr="";
     }
     else {
      $lastnameErr="Please enter only alphabets";
      }
      if(empty($_POST['email'])){
        $emailErr="Please enter Email";
    }
    elseif(preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
        $email = $_POST['email'];
        $emailErr="";
    }
    else {
        $emailErr="Please enter a valid email address";
    }
    
     if(empty($_POST['contact'])){
      $contactErr="Please enter contact no";
     }
     elseif(preg_match('/^9[78][0-9]+$/', $contact)) {
      $contact = $_POST['contact'];
      $contactErr="";
     }
     else {
      $contactErr="Please enter valid contact";
      }
     if(empty($_POST['address'])){
      $addressErr="Please enter address";
     }
     elseif(preg_match('/^[a-zA-Z0-9\s\.,#-]+$/', $address)) {
      $address= $_POST['address'];
      $addressErr="";
     }
     else {
      $addressErr="Please enter valid address";
      }
      if(!isset($_POST['username'])){
        $usernameErr="Please enter username";
       }
       elseif(preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&+=])(?=.*[a-zA-Z\d@#$%^&+=]).{8,}$/', $username)) {
        $username= $_POST['username'];
        $usernameErr="";
           }
           elseif(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&+=])(?=.*[a-zA-Z\d@#$%^&+=]).{8,}$/', $username)) {
            $usernameErr="Please enter valid username";
               }
       else {
        $usernameErr="";
         }
       if (empty($_POST['password'])) {
        $passwordErr = "Please enter password";
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&+=])(?=.*[a-zA-Z\d@#$%^&+=]).{8,}$/', $password)) {
        $passwordErr = "Please enter a valid password";
    } else {
        if ($username == $password) {
            $passwordErr = "Username and password can't be the same";
        } else {
            $password = $_POST['password'];
            $passwordErr = "";
        }
    }
    if (empty($_POST['confirmpassword'])) {
      $confirmpasswordErr = "Please enter confirm password";
  } elseif ($_POST['confirmpassword'] !== $password) {
      $confirmpasswordErr = "Password and confirm password must be the same";
  } else {
      $confirmpassword = $_POST['confirmpassword'];
      $confirmpasswordErr = "";
  }
          
         }
  
       
      
    






      if(!$firstnameErr && !$lastnameErr && !$emailErr && !$contactErr && !$usernameErr && !$passwordErr && !$addressErr && !$confirmpasswordErr){
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
              
              echo '<script language="javascript">';
              echo 'alert("Email Already exists!!")';
              echo '</script>';
              sleep(2);
              header("Location:loginpage.php");
           }
           elseif($uflag){
             
              echo 'alert("Username Already exists!!")';
              echo '</script>';
              header("Location:loginpage.php");
              echo '<script language="javascript">';
           }
        }
        
        
        else {
          $connect->query("INSERT INTO registeruser(`id`, `FirstName`, `LastName`, `Email`, `ContactNumber`, `Address`, `Username`, `Password`, `remember_token`) 
          VALUES (NULL, '$fname', '$lname', '$email', '$contact', '$address', '$username', '$password', '$remember')");
          $id = "select id from register where email = '" . $_POST['email'] . "' and password = '" . $_POST['password'] . "' ;";
          session_start();
          // $_SESSION['email'] = $email;
          // $_SESSION['pwd']   = $password;
          // $_SESSION['user']  = $fname;
         
          echo '<script language="javascript">';
          echo 'alert("User Registered Successfully!")';
          echo '</script>';
          // header("Location:loginpage.html");
        }
        $connect->close();  // close Connection
      
      }
      else {
        echo $firstnameErr . "<br>" . $lastnameErr . "<br>" . $emailErr . "<br>" . $contactErr . "<br>" . $usernameErr . "<br>" . $passwordErr . "<br>" . $addressErr;
    }
    
   

  
 

?>


<!DOCTYPE html>
<html>
  <head>
    <title>Registration Page</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
      }
      .container {
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        margin: 50px auto;
        max-width: 500px;
        padding: 30px;
      }
      h2 {
        margin-top: 0;
      }
      label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
      }
      input[type="text"],
      input[type="email"],
      input[type="password"],
      input[type="tel"],
      textarea {
        border-radius: 3px;
        border: 1px solid #ccc;
        box-sizing: border-box;
        margin-bottom: 20px;
        padding: 10px;
        width: 100%;
      }
      input[type="submit"] {
        background-color: #4caf50;
        border: none;
        border-radius: 3px;
        color: #fff;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        padding: 10px;
        width: 100%;
      }
      input[type="submit"]:hover {
        background-color: #3e8e41;
      }
      .error {
        color: red;
        font-weight: bold;
        margin-top: 5px;
      }
      
        .password-toggle {
            position: relative;
        }

        .password-toggle input[type="password"] {
            padding-right: 30px;
        }

        .password-toggle .toggle-btn {
            position: absolute;
            top: 50%;
            right: 5px;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
    <!-- <script>
      function validatePassword() {
        const password = document.getElementById("password").value;
        const regex = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{8,}$/;
        if (!regex.test(password)) {
          document.getElementById("password-error").textContent =
            "Password must have at least 8 characters including 1 capital letter, 1 number, and 1 special character.";
          return false;
        } else {
          document.getElementById("password-error").textContent = "";
          return true;
        }
      }
    </script> -->
 
  </head>
  <body>
    <?php include 'Connection.php';?>
    <div class="container">
      <h2>Registration</h2>
      <form action="<?php echo $_SERVER['PHP_SELF']   ?>" method="post" >
      <!-- <form action="" method="post" onsubmit="return validatePassword()"> -->
        <label for="firstname">First Name: <span style="color:red;"><?php echo $firstnameErr; ?></span></label>
        <input type="text" id="firstname" name="firstname" placeholder="Bipul" >
        <label for="lastname">LastName: <span style="color:red;"><?php echo $lastnameErr; ?></span></label>
        <input type="text" id="lastname" name="lastname" placeholder="Wagle" >
        <label for="email">Email:<span style="color:red;"><?php echo $emailErr; ?></span></label>
        <input type="email" id="email" name="email" placeholder="Bipul@gmail.com">
        <label for="contact">Contact No:<span style="color:red;"><?php echo $contactErr; ?></span></label>
        <input type="tel" id="contact" name="contact" placeholder="98XXXXXXXX" >
        <label for="address">Address:<span style="color:red;"><?php echo $addressErr; ?></span></label>
        <textarea id="address" name="address" placeholder="Address"></textarea>
        <label for="username">Username:<span style="color:red;"><?php echo $usernameErr; ?></span></label><br>
        <input type="text" id="username" name="username" placeholder="Bipul@bipul11" >
        <label for="password">Password:<span style="color:red;"><?php echo $passwordErr; ?></span></label>
        <input type="password" id="password" name="password" >  <span id="toggle-button" class="toggle-btn" onclick="togglePasswordVisibility()">Show</span>
        <p id="password-error" class="error"></p>
        <label for="confirmpassword">Confirm Password:<span style="color:red;"><?php echo $confirmpasswordErr; ?></span></label>
        <input type="password" id="confirmpassword" name="confirmpassword" >  <span id="confirmtoggle-button" class="toggle-btn" onclick="toggleconfirmPasswordVisibility()">Show</span>
        <p id="password-error" class="error"></p>
        <button type="submit" class="btn btn-primary btn-user btn-block" name=" btnsubmit">Register Account</button>
      </form>
    </div>
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var toggleButton = document.getElementById("toggle-button");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleButton.innerText = "Hide";
            } else {
                passwordInput.type = "password";
                toggleButton.innerText = "Show";
            }
        }
        function toggleconfirmPasswordVisibility() {
            var confirmpasswordInput = document.getElementById("confirmpassword");
            var confirmtoggleButton = document.getElementById("confirmtoggle-button");

            if (confirmpasswordInput.type === "password") {
                confirmpasswordInput.type = "text";
                confirmtoggleButton.innerText = "Hide";
            } else {
                confirmpasswordInput.type = "password";
              confirmtoggleButton.innerText = "Show";
            }
        }
    </script>
    <?php 
      ?>
  </body>
</html>
