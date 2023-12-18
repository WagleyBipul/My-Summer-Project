<?php
   include 'Finalheader.php';
   session_start();
   
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\SMTP;
   use PHPMailer\PHPMailer\Exception;

   if (isset($_SESSION['user'])) 
   {
    $unm=$_SESSION['user'];
   }
   else{
     $unm="Notloggedin";
   }
   

   

//    if(!isset($_SESSION['loggedin'])|| $_SESSION['loggedin']!==true){
//     header("Location:loginpage.php");
//    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body 
        {
            /* overflow-x: hidden; */
            margin: 0;
            padding: 0;
          
        }
    
  .img1 {
    margin-top:4%;
    text-align: center; 
    box-shadow: 0 3px 10px rgb(0 0 0 / 0.8);

}

.img1 img {
    margin-top:-2%;
    max-width: 100%; /* Ensure the image doesn't exceed its parent's width */
    height: auto; /* Maintain the image's aspect ratio */
    
}

  .text-overlay 
{
            position: absolute;
            top: 50%; /* Adjust vertical position as needed */
            left: 50%; /* Adjust horizontal position as needed */
            transform: translate(-50%, 200%);
            /* background-color: rgba(0, 0, 0, 0.5);  */
            color:  #F9AD57;
            /* opacity:70%; */
            padding: 10px;
            font-size: 5em; /* Adjust font size as needed */
            font-family: arial, calibri, san-seriff;
            font-weight: Bold;
}

.aboutus 
{
        background-color: whitesmoke;
        color: olive;
        font-weight: bold;
       
        width:100%;
        margin-top:2%;
        
        box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
}

    .aboutus h2 
    {
        text-align: center;
        color: white;
        font-size: 2em;
        font-weight: lighter;
        background-color: olive; 
        padding: 10px; 
    }

    .aboutus p 
    {
        text-align: center;
        font-size: 18px; /* Adjust the font size as needed */
        line-height: 1.5; /* Adjust line height for better readability */
        margin-top: 20px; /* Add some top margin for spacing */
        padding: 10px; /* Add padding for better readability */
        font-weight: lighter;
    }

.belowbanner
{
    margin-top:50px;
    margin-left:100px;
    display:grid;
    grid-template-columns:500px 500px;

}
.belowbannertxt
{
    background-color: whitesmoke;
        color: olive;
        font-weight: bold;
        margin-left: %;
        width:100%;
        margin-top:2%;
        box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);

}
.belowbannertxt h2
{
        text-align: center;
        color: white;
        font-size: 2em;
        font-weight: lighter;
        background-color: olive; 
        padding: 10px; 
    
 } 

 .simpletxt
 {
    color:green;
    margin-left:0px;
    margin:0%;
    background: #FFC107;
    color: #ffffff;
    width:400px;
    text-align:center;
 }
  
.cricbox img
{
    height:500px;
    width:400px;
    /* border:1px solid green; */
    box-shadow: 0 5px 10px rgb(0 0 0 / 0.8);

}
.futbox img
{
    height:500px;
    width:400px;
    /* border:1px solid green; */
    box-shadow: 0 5px 10px rgb(0 0 0 / 0.8);

}
.cricbox,
.futbox 
{
    position: relative;
    display: inline start;
}

.text-overlay1 
{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-70%, -50%);
    background-color: rgba(0, 0, 0, 0.8); 
    color: white;
    padding: 1%;
    font-size: 20px;
    font-family: Arial, Calibri, sans-serif;
    font-weight: bold;
    text-align:center;
}

.text-overlay2
{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-70%, -50%);
    background-color: rgba(0, 0, 0, 0.8); 
    color: white;
    padding: 1%;
    font-size: 20px;
    font-family: Arial, Calibri, sans-serif;
    font-weight: bold;
    text-align:center;
}
.text-overlay1 a,.text-overlay2 a
{
    color:white;
    text-decoration:none;
}

.ads img
{
    height:auto;
    width:150%;
    margin-top:10%;
    align-items:center;
    justify-content:center;
    box-shadow: 0 5px 10px rgb(0 0 0 / 0.8);
    margin-left:13%;
    margin-bottom: 10%;
 
}

.dashboard-container {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 50px;
    transform: translate(-63%, 90%);

}

.dashboard-card 
{
            border-radius: 3px;
            width: 800px;
            height: 300px;
            padding: 50px;
            margin: 2%;
            border-radius: 10px;
            text-align: center;
            background-color: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-top:-1%;

}

.dashboard-card a {
    text-decoration: none;
    color: #333;
}

.dashboard-card h2 {
    margin: 5%;
    font-size: 20px;
}

.dashboard-card p {
    font-size: 14px;
    color: #666;
    margin:3%;
    font-weight:lighter;
    /* white-space: nowrap; */
    color:navy;
    margin-top:1%;
}

/* 

.map-card 
{
        margin:5%;
        border-radius: 3px;
        text-align: center;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.7);
        transform: translate(3%,75%); 
        margin-left:23%;
        width:600px;
        height:450px;

}
.commentform
{
    transform: translate(-63%,130%); 
    background-color: #f5f5f5;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    width: 500px;
    margin: 0 auto;
    text-align:center;
    align-items:center;
    margin-bottom:5%;
} */
.map-card,
        .commentform {
            width: 100%;
            margin: 2.5%;
            display: inline-block;
            vertical-align: top;
            margin-top:70%;
        }
        .map-card 
        {
            transform:translate(-30%,0);
        }

        .commentform {
            background-color: #f5f5f5;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            margin-left:50px;
        }
.commentform legend 
{
    font-size: 20px;
    font-weight: lighter;
    margin-bottom: 10px;
    color: crimson;
    text-align:center;
}

.commentform input[type="text"],
.commentform input[type="number"],
.commentform input[type="email"],
.commentform textarea {
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    width:80%;
}

.commentform textarea {
    resize: vertical;
}

.commentform input[type="submit"] {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
}

.commentform input[type="submit"]:hover 
{
    background-color: #0056b3;
}
.commentform .p1 
{
    font-size:1.0em;
    font-weight:lighter;
    margin-bottom:5px;
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
    margin-left:-16%;
    
}

/* Style for the copyright text */
.copyright {
    font-size: 14px;
    margin: 0; /* Remove default margin */
}


</style>
</head>
<body style="background:whitesmoke;">
<div class="container">

    <div class="img1">
        <div class="text-overlay">Velocity Arena </div>
        <img src = "c2.jpg"  alt="landing photos" />
    </div>

<div class="aboutus">
        <h2>About Us </h2>
        <p> Welcome to Velocity Arena! We are a premier provider of indoor football and cricket entertainment, 
            catering to individuals of all ages. With our establishment in 2010, conveniently situated at Ratopul Chowk, 
            Ratopul, we bring the thrill of sports to enthusiasts and beginners alike. At Velocity Arena, we strive to create 
            an accessible and inclusive environment by offering affordable indoor courts for futsal and cricsal. Our aim is to 
            promote physical fitness, foster a sense of camaraderie, and provide a memorable experience for our valued customers.
        </p>
</div>

   <div class="belowbannertxt">
        <h2>Booking Redirections</h2>
    </div>
    
   <div class="belowbanner">
         
        <div class="cricbox">
            <a href="Cricsalbooking.php"> 
                <img src="edit1.jpg">
            </a>
            <div class="text-overlay1">
            <a href="Cricsalbooking.php"> 
                Click for Cricksal Booking
            </a>
        </div>
    </div>

<div class="futbox">  
        <a href="Futsalbooking.php"> 
            <img src="shoe_football.jpg">
        </a>
        <div class="text-overlay2">
            <a href="Futsalbooking.php"> 
                Click for Futsal Booking
            </a>
        </div>
</div>

   <div class="ads">
     <img src="add.jpg">
   </div>

   <div class="dashboard-container ">

        <div class="dashboard-card">
            <img src="bookings.svg" alt="Card 1">
            <h2>Futsal Booking</h2>
            <p>Book the futsal venue to play with your friends.</p>
        </div>
        <div class="dashboard-card">
            <img src="register.svg" alt="Card 2">
            <h2>User Registration</h2>
            <p>Register Users for various Accessibilities.</p>
        </div>

        <div class="dashboard-card">
            <img src="search.svg" alt="Card 3">
            <h2>Accessories</h2>
            <p>Search our top class sports accessories.</p>
        </div>

    </div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
   
    <div class="footer">
        <p class="copyright">&copy; 2023 Velocity Arena </p>
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

