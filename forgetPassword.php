<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the email entered in the forgot password form
  $email = $_POST['email'];

  // Validate the email (you can add more validation checks)
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Invalid email format";
  } else {
    // Generate a random password reset token
    $token = bin2hex(random_bytes(32));

    // Store the token and associated email in a database table
    // (You would need to have a database connection established)

    // Update the user's record in the database with the token
    $sql = "UPDATE registeruser SET reset_token = '$token' WHERE email = '$email'";
    // Execute the SQL query

    // Send the password reset email to the user
    $resetLink = "http://example.com/reset_password.php?token=$token";
    $message = "Click the following link to reset your password: $resetLink";
    // Use the mail function or a library like PHPMailer to send the email

    // Display a success message to the user
    $success = "Password reset instructions have been sent to your email.";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Forgot Password</title>
</head>
<body>
  <h2>Forgot Password</h2>
  <?php if (isset($error)) { ?>
    <p><?php echo $error; ?></p>
  <?php } elseif (isset($success)) { ?>
    <p><?php echo $success; ?></p>
  <?php } else { ?>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>
      <input type="submit" value="Reset Password">
    </form>
  <?php } ?>
</body>
</html>
