<?php
    ob_start();
   include 'Finalheader.php';
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\SMTP;
   use PHPMailer\PHPMailer\Exception;
   if(isset($_POST['submit'])){
    $fullname=$_POST['fullname'];
    $number=$_POST['number'];
    $email=$_POST['email'];
    $message=$_POST['message'];

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

          //Recipients
          $mail->setFrom('waglebipul02@gmail.com', 'Sender@feedback.com');// Replace with your email and name
          $mail->addAddress($clientEmail); // Add a recipient


          // Content
          $mail->isHTML(true); // Set email format to HTML
          $mail->Subject = 'New Message from';
          $mail->Body    = 'You have got new message from :-> '.$fullname.'<br>Email->'.$email.'<br>Message->'.$message;
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

      header('location:contactus.php');
      exit();
  
}

   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
  
.map-card 
{       
        border-radius: 3px;
        text-align: center;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.7);
        margin-top:5%;
        margin-left:10%;
        width:500px;
        height:450px;

}
.commentform
{
    
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
            width: 500px;
            margin: 2.5%;
            display: inline-block;
            vertical-align: top;
            margin-top:70%;
        }


        .commentform {
            background-color: #f5f5f5;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            margin-left:1100px;
            margin-top:-1162px;
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
        </style>
</head>
<body>
    
<div class="map-card">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.319297501014!2d85.
                33888029930839!3d27.70742617689078!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1975eef701b7%3A0x4
                20d5d941d2cd850!2sVelocity%20Arena-%20Nepal%20cricket%20school!5e0!3m2!1sen!2snp!4v1686977321393!5m2!1sen!2snp"
                width="500" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
    </div>
    
    <div class="commentform" style="margin-top:-33%; margin-left:700px;">
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <legend>Any message for us !!</legend>
            <p class = "p1">Full Name:</p><input type="text" name="fullname" placeholder="John Doe"><br>
            <p class = "p1">Number :</p><input type="number" name="number" placeholder="+977-9876564926"><br>
            <p class = "p1">Email :</p><input type="email" name="email" placeholder="johndoe@gmail.com"><br>
            <p class = "p1">Message:</p><textarea name="message" rows="2" cols="40"></textarea><br>
            <input type="submit" value="Submit" name="submit"> 
        </form>
    </div>
</body>
</html>