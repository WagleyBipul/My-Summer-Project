<?php
session_start();
// if(!isset($_SESSION['loggedin'])|| $_SESSION['loggedin']!==true){
//     header("Location:loginpage.html");
//     exit;
//    }

// $username=$_SESSION['user'];

if (isset($_SESSION['user'])) 
{
 $username=$_SESSION['user'];
}
else{
  $username="Notloggedin";
}
// echo $email;
include 'connection.php'; 
include 'Finalheader.php';
$connect = mysqli_connect("localhost", "root", "") or die("Unable to connect to MySQL Sever.");
require 'config.php';
$sql="SELECT FirstName FROM registeruser WHERE Username='$username'";
    $result=mysqli_query($connect,$sql);
    $row = $result->fetch_assoc();
//    Step 4: Display the row data
    if ($row) {
    // echo "Hello : " . $row['FirstName'] . "<br>";
    // echo "Name: " . $row['lname'] . "<br>";
    // Display other column values as needed
    } else {
    // echo "No rows found.";
    }

// Close the statement and connection
?>

<!DOCTYPE html>
<html>
<head>
	<title> Futsal Book</title>
	<script src="javascript/jvs.js"></script>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Booking Page</title>
    <style>

	body
	{
		margin:0;
		padding:0;
		overflow-x: hidden;
	
	}
    #bs-example-navbar-collapse-1 ul li a{
        color:green;
    }
    #bs-example-navbar-collapse-1 ul li a:hover{
        background:green;
        color:white;
        border-radius:20px;
    }
    .active
	{
    	background-color:lightgreen;

}
	.btn-success
	{
		color:black;

		/* font-weight:bold; */
		/* edits radio button items */
	}
	.btn-success1
	{
		color:gray;
		padding: 0.5%;

		/* margin:1%; */
		/* font-weight: bold; */
	}
	.btn-success2
	{
		padding: 1%;
		
		/* this is proceed button */
	}
	.img
	{
		text-align:center;
		align-items:center;
		margin-top:-3%;
		margin-left:15%;
		/* box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22); */
		width:500px;
		filter: blur(3px);
-webkit-filter: blur(3px);
		display:flex;
		position:absolute;
	
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
</head>
<body style=" background:Whitesmoke;">
                 <?php
                    // if(isset($_SESSION['email']))
                    // {  
                    //  if($_SESSION['email'] == 'admin' )
                    //     echo 'admin.php';
                    // else
                    //     echo 'customer.php';
                    // }
                    // else 
                    //   echo 'index.php';

                    ?> 
                  
    <br><br>
	<div class="img">
		<img src="f6.jpg" style="margin-left:-15%; opacity:0.99; text-align:center, align-items:center, justify-content:center; width:1100px; height:auto;"/>
	</div>
	<div style="position: relative; color:black; left :6%; font-size: 20px; margin-top:0%; margin-left:50px;">
       
		<form name="booking" action="Futsalbooking.php" method="POST">
    	<p style="text-align:center, 
					align-items:center, 
					justify-content:center;
					font-size:1.2em;
					font-weight:bold;
					margin-left:3%;"><label>Select Date:</label>
    	<input type = "date" name = "bookdate" style="color:#222;" value="<?php 
    							if(isset($_POST['dSubmit']))
    								echo $_POST['bookdate'];
    							else{
    								$today=time()+13500;
    								echo (date("Y-m-d",$today));
    							}
    								?>" required>
    	<span class="btn-group-sm">
        <script>
         var curr = new Date();
            function myFunction(a)
            {

                // document.getElementById("demo").innerHTML = a * b;
                var dateA = new Date(a);
                var dateB = new Date(curr);
                if(dateA < dateB)
                {
                    alert("Invalid Date please re-enter the date!");
                    document.getElementByName('bookdate').focus();
                }
            }
        </script>
        <input type="submit" class="btn-success1 " value="Check" name="dSubmit" onclick="myFunction(bookdate.value);"></input></span>
    	</p>
		</form>
	</div>
	<script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

	<div class="footer">
    <p class="copyright">&copy; 2023 <a style="text-decoration:none; color:white;" href="home.php">Velocity Arena</a></p>
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
</body>
</html>
<?php
		$connect = mysqli_connect("localhost","root","") or die ("Unable to connect to MySQL Sever.");
		require 'config.php';
		//session_start();
		if(isset($_POST['dSubmit']))
        {
			$bookdate = $_POST['bookdate'];
            //$hr       = $_POST['hr'];
            $timestamp = strtotime($bookdate);
            $x=time();
            //echo $bookdate .' = '. $timestamp;
            //echo '<br>Today = '. time();
            //$timestamp+ = $hr;
            if(($timestamp-$x)<0){
                echo '  <script language="javascript">
                        alert("Sorry you enterd expired date value!!\nPlease select a valid date. \nDate has been reverted to current date! ");
                        window.location.replace("Futsalbooking.php");
                        </script>';
                //$t=time()+13500;
                //$bookdate=date('Y-m-d',$t);

            }
        }
		else
		{
			$t=time()+13500;
			$bookdate=date('Y-m-d',$t);
		}
		
			$deadline=time()-72900;
			$today=time()+13500;
			$bktime = "delete from booking where timecheck < '$deadline' and confirm_key = 1";
			$connect->query($bktime);
			$allshifts = 
			array ('6-7', '7-8', '8-9', '10-11','12-13', '14-15', '16-17', '17-18', '18-19', '19-20');
			//$allshift= array ('A', 'B', 'C', 'D','E', 'F', 'G', 'H', 'I', 'J');
			$pricequery="SELECT Price FROM prices";
			global $futsalprice;
			$priceresult=$connect->query($pricequery);
			if(mysqli_num_rows($priceresult)>0){
			 while($price=mysqli_fetch_assoc($priceresult)){
				 $futsalprice=$price['Price'];
			 }
			}
			$test = "select shift from booking where bookday='".$bookdate."'";
			$allbookings = $connect->query($test);
			$i=0;
			$testarr = array(); 
			while($test = $allbookings->fetch_assoc())
			{
				$testarr[$i]=$test['shift'];
				$i++;
			}
			$result=array_diff($allshifts, $testarr);

			echo '<div style ="position:relative; 
						top : 20px; 
						left : 5%; 
						margin: 10px;
						margin-left:45px;
						height:90%; 
						width:80%; 
						font-size: 18px;  
						padding : 3px; 
						color:black;">
				<form style="margin-left:5%; font-weight:light;color:black;" name = "shiftselect" action = "Futsalvalidate.php"  method = "POST"> 
					<b>Select your Shift (one at a time) and then press the proceed button. <br>
                    Selected Shifts will be booked for the date:</b>
						<div style = "color: #000080;
									font-weight:bold; 
									margin-left:0%;
									margin-top:10px;
									font-size:24px;">'.$bookdate.'
						</div>
						<br>

                <table  style = "box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
								 margin-top:-3%;
								 width:100%;
								 margin-bottom:3%;
								 background-color:#e6f5ff;
								 text-align:center;
								 

								" 
								border="0" cellspacing="40" cellpadding="50" height = "20%">
								<br><br><br>
								<tr  height= "10px"  class="btn-group-justified">';
			for($i=0;$i<10;$i++)
			{
				if(isset($result[$i])){
					// inside radio button css settings
					echo '<td style="color:white;   
			
							font-size:16px;
							font-weight:bold;
							margin:1.5%;
							left:-2%;"  
							align="center" 
							class="btn btn-success">';

					echo '<strong><input  type="radio" name="shift" style="margin:2px;"value='.$result[$i].' required></strong>'.$result[$i];
					echo '</td>';
                    

				}
				else
				{
					echo '<td style="color:red; 
							font-size:20px; 
							margin:1.5%;
							align="center" 
							class="btn btn-warning" >';

					echo '<strong><input type="radio" name="shift" disabled></strong>'.$allshifts[$i];

					echo '</td>';
				}
				
			}
			echo '</tr></table>
			<input type="hidden" value="'.$futsalprice.'" name="futsalprice">
				  <input type = "hidden" name = "bookdate" value = "'.$bookdate.'"> <br><br>
				  <input type = "submit" style="color:white; 
				  								background-color:#078E58;
				  								font-size:22px;
												font-weight:500;
												border:0;
												box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
												margin-top:-60px;
				  								align="center" 
				  class="btn btn-success2" value ="Proceed" name = "proceed">
				 
				  </form>
				  <br>
				<div style="position: relative; font-size:20px; float: right; margin-top:-100px;" >
				  <b style="margin-left:-450px;
				  			color:navy;">
							Price:'.$futsalprice.'
				  </b><br>

        			<button type="button"
					style="color: white; 
					padding:10px;
					margin-left:0;
					margin-top:-30%;
					border:0;
					box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
					font-size:22px;"  
					align="center" 
					class="btn btn-success">Available
				</div>

				<div style="position: relative; font-size:20px; float: right; margin-top: -11.5%;" >
       				<input type="radio" id="radio1" hidden disabled></button>
       				<button type="button" class="btn btn-warning" 
					style="color:red; 
					border:0;
					box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
					padding:10px;
					margin-left:-110%;
					margin-top:20%;
					font-size:22px;"  
					align="center" 
					class="btn-success2">Reserved

        			<input type="radio" id="radio2" hidden disabled> </button>               
     			</div>
				<br>
			</div>';	

		    // if(isset($_POST['proceed']))
		    // {
		    // 	if(!empty($_SESSION['email']))
			// 	{
		    // 	$email=$_SESSION['email'];
		    // 	$bookday=$_POST['bookdate'];
		    // 	$shift=$_POST['shift'];
		    // 	$t=time();
		    // 	$details = "select contact,fname from register where email='".$email."'";
		    // 	$test = $connect->query($details);
		    // 	$details=$test->fetch_assoc();
		    // 	$user=$details['fname'];
		    // 	$contact=$details['contact'];

		    // 	$connect->query("INSERT INTO booking (`id`, `user`, `bookday`, `shift`, `contact`, `email`, `timecheck`, `confirm_key`) 
		    // 									VALUES (NULL, '$user', '$bookday', '$shift', '$contact', '$email', '$t','0');");	
		    //     $connect->close();
		    //     }
		    //  else
		    //  {
		    //  	echo '  <script>
			// 		var key= confirm("Login First!");
					
			// 		</script>';
					
		    //  }    	

		    // }	
    
    // include("footer.php");		
?>
