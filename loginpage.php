<?php 
ob_start();
include 'Finalheader.php';
session_start();
$connect = mysqli_connect("localhost", "root", "") or die("Unable to connect to MySQL Sever.");
require 'config.php';
  


        if (isset($_POST['login'])) {  
          if(empty($_POST['username']) || empty($_POST['pwd'])){
         
            echo "<script>alert('Username or password not entered')</script>";
      }
      else{
       
        if ($_POST['username'] == "admin" && $_POST['pwd'] == "admin") {
          $_SESSION['loggedin'] = true;
          $_SESSION['user']="admin";
          $_SESSION['contact']="00000";
          $_SESSION['address']="Velocity";
          header("Location: Admin.php");
           exit();
} else {
      $pwd = $_POST['pwd'];
       $username = $_POST['username'];

       $query = "SELECT * FROM registeruser WHERE Username = '$username' AND Password = '$pwd'";
       $result = mysqli_query($connect, $query);

          if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);

                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $row['Email'];
                $_SESSION['pwd'] = $row['Password'];
                $_SESSION['user'] = $row['FirstName'];
                $_SESSION['contact'] = $row['ContactNumber'];
                $_SESSION['address']= $row['Address'];
                $address=$_SESSION['address'];

                        if (isset($_POST['rememberme'])) {
                            // Generate a unique token
                            $token = uniqid();

                            // Store the token in the database
                            $username = $row['Username'];
                            $updateTokenQuery = "UPDATE registeruser SET remember_token = '$token' WHERE Username = '$username'";
                            mysqli_query($connect, $updateTokenQuery);

                            // Set the token as a cookie
                            setcookie('remember_token', $token, time() + 3600); // Cookie expires in 1 hour
                        }

            header("Location: Home.php?Address=$address");
            exit();
           } else {
         echo '<script language="javascript">';
        echo 'alert("Invalid Username or Password not in database !!!")';
        echo '</script>';
        header("location: loginpage.php");
              exit();
           }
} 

      }



    //   if (isset($_POST['rememberme'])) {
    //     echo "Checked";
    //   }
    //   if (isset($_COOKIE['remember_token'])) {
    //   $token = $_COOKIE['remember_token'];

    //   $query = "SELECT * FROM registeruser WHERE remember_token = '$token'";
    //   $result = mysqli_query($connect, $query);

    //   if (mysqli_num_rows($result) == 1) {
    //       $row = mysqli_fetch_assoc($result);

    //       $_SESSION['loggedin'] = true;
    //       $_SESSION['email'] = $row['Email'];
    //       $_SESSION['pwd'] = $row['Password'];
    //       $_SESSION['user'] = $row['FirstName'];
    //       $_SESSION['contact'] = $row['ContactNumber'];
        

    //       header("Location: Home.php");
    //       exit();
    //   }
    // }
    }
    

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Login Page</title>
    <style>
      *
      {
        margin:0;
        padding:0;
      }
      body {
        font-family: Arial, sans-serif;
        background-color: white;
        overflow:hidden;
      
      }
      .container1
      {
        background-color:#eedddd;
        padding:20px;
        border-radius: 15px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        transform:translate(120%,-140%);
        box-shadow:rgba(0,0,0,0.24) 0px 3px 8px;
        max-width: 300px;
        margin-left:25%;
        align-items:center;
        justify-content:center;
      
      }

      label
      {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
      }

      input[type="text"],
      input[type="password"] 
      {
        border-radius: 3px;
        border: 1px solid #ccc;
        box-sizing: border-box;
        margin-bottom: 35px;
        margin-top:-20px;
        padding: 10px;
        width: 100%;
      
        
      }

      button[type="submit"] {
        background-color:whitesmoke;
        border: none;
        border-radius:5px;
        color:black;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        padding: 10px;
        width: 30%;
      
      }
      button[type="submit"]:hover{
        background:red;
        color:red;
      }
      input[type="submit"]:hover {
        background-color:red;
        
        
      }

      .register-link {
        text-align: center;
        margin-top:-35px;
        margin-left:70px;
      

      }
      .register-link a {
        color:green;
        text-decoration: none;
        border:1px solid white;
        padding:11px;
        border-radius:5px;
      }
      .form-check
      {

        margin-top:50px;
        display:flex;
        position:absolute;
        margin-bottom:50px;


        /* margin-bottom:7px; */
        /* margin-left:27%; */
        /* this changes remember me button */
        /* transform:translate(0%,-130%); */
      }
      .form-check label
      {
        font:18px arial; 
        white-space:nowrap;
        text-align:left;
      }

      .fp
      {
        /* margin-left:150px; */
        /* margin-top:-50px; */
        white-space: nowrap;
        margin-top:90px;
        display:flex;
        position:absolute;
        margin-bottom:25px;

        /* transform:translate(10%,-110%); */

      }
      .whole
      {
        background:url('login_img.png');
        width: 1000px;
      }
      .imageX
      {
        margin-top:-13%;
        width:80%;
        margin-left:25%;
      }

      .footer1{
        margin-top:-460px;
    background-color: gray;
    /* color:  #FFC000; */
    color:  white;
    text-align: center;
    padding: 10px 0;
    
    
    width: 84%;
    margin-left:120px;
   opacity: 1; /* Initially hidden */
    transition: opacity 0.3s ease; /* Smooth transition */
    display: flex;
    justify-content: center;
    align-items: center;
    text-align:center;
    height: 50px;
     /* Adjust the height as needed */
    /* margin-left:-18.2%; */
    
}

/* Style for the copyright text */
.copyright {
    font-size: 14px;
    margin: 0; /* Remove default margin */
}
.photoX
{
  align-items:center;
  margin-left:13%;
  margin-top:-30%;
  margin-bottom:3%;


}


    /* color: white;
    text-align: center;
    padding: 10px 0;
    position: relative; /* Change position to relative */
    /* width: 100%;
    opacity: 0; /* Initially hidden */
    /* transition: opacity 0.3s ease; /* Smooth transition */
    /* display: flex; */
    /* justify-content: center; */ */
    /* align-items: center; */
    /* text-align: center; */
    /* height: 30px; Adjust the height as needed */
    /* bottom: auto; */ */ */
    /* Remove fixed positioning from the bottom */

    </style>
  </head>
  <body>
    <div class="whole">
      <img class="imageX" src="main_login.png" style="margin-top:-210px;">
    <div class="container1" style="margin-top:-45px; background:lightgreen;">
      <h2 style= "text-align:center; margin-bottom:5px; align-items:center; justify-content:center;">Login</h2>
      <form  method = "POST" action ="<?php echo $_SERVER['PHP_SELF'] ?>"  id= "myForm" >
        <p style= "margin-bottom:0px; align-items:center; justify-content:center; font-size:16px;" 
        class="text-center h3 fw-bold mb-5 mx-1 mx-md-4 mt-4"  >Please Login to Your account</p>

        <!-- Email input -->
        <div class="form-outline mb-4">
          <input type="text" name="username" id="username" placeholder="Enter Username" class="form-control form-control-md" />
        </div>

        <!-- Password input -->
        <div class="form-outline mb-4">
          <input type="password" name="pwd" id="pwd" placeholder="Enter Password" class="form-control form-control-md" />
          
        </div>

        <div class="d-flex justify-content-around align-items-center mb-4">

          <!-- Checkbox -->
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="Remember Me" id="form1Example3" name="rememberme"  style="margin-left:-140px;">
            <label class="form-check-label" for="form1Example3" style="margin-left:-120px;"> Remember me </label>
          </div>
          <a href="forgetPassword.php" class="fp" style="margin-left:120px;">Forgot password?</a>

        </div>

        <button style="margin-left:25px; height:45px;color:green;background:white;margin-top:40px; align-items:center; justify-content:center;" type="submit" name='login' >Sign in</button>
      

        <!-- Submit button -->
      <div class="register-link">
        <a href="registrationPage.php" style="background:white; margin-left:70px;font-weight:bold; " name="register" >Register</a>
      </div>
    </div>
  </div>
  <!-- <div class="photoX">
    <img src = "footcric.jpg" alt="banner_photo"/>
  </div> -->

  
  <div class="footer1" style="margin-top:-470px; overflow:hidden;">
    <p class="kidher" >&copy; 2023 Velocity Arena </p>
</div>

<!-- <script>
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
</script> -->
  </body>
</html>

<?php 
ob_end_flush(); 