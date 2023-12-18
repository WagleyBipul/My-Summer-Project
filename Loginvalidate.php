<?php 

// session_start();
//yo page refrence ko lagi matra ho code ma kam xaina
$connect = mysqli_connect("localhost", "root", "") or die("Unable to connect to MySQL Sever.");
require 'config.php';
$address="";

if (isset($_POST['login'])) {
    if ($_POST['username'] == "admin" && $_POST['pwd'] == "admin") {
        $_SESSION['loggedin'] = true;
        $_SESSION['user']="admin";
        $_SESSION['contact']="00000";
        $_SESSION['address']="Velocity";
        $user="admin";

        sleep(2);
        // header("Location: Admin.php?user=admin");
        exit();
    } else {
        $pwd = $_POST['pwd'];
        $username = $_POST['username'];

        $query = "SELECT * FROM registeruser WHERE Username = '$username' AND Password = '$pwd'";
        $result = mysqli_query($connect, $query);

        if (mysqli_num_rows($result) >0 ) {
            $row = mysqli_fetch_assoc($result);
   
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $row['Email'];
            $_SESSION['pwd'] = $row['Password'];
            $_SESSION['user'] = $row['FirstName'];
             $contactNumber= $row['ContactNumber'];
             $_SESSION['contact'] = $contactNumber; // Setting contact number in the session
             $address=$row['Address']; 
             $_SESSION['address'] = $address;  // Setting address in the session
           

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

            header("Location:Store.php?");
            exit();
        } else {
            echo '<script language="javascript">';
            echo 'alert("Invalid Username or Password!!!")';
            echo '</script>';
            sleep(2);
           
            
        }
    }
}

if (isset($_POST['rememberme'])) {
    echo "Checked";
}
?>
