<?php
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'Finalheader.php';
include 'connection.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: loginpage.html");
    exit;
}

$productname = $imgname = $productprice = $productdescription = ""; // Initialize variables

if (isset($_GET['name'])) {
    $product = $_GET['name'];
    // $name = $_GET['name']; // Assuming 'name' is a URL parameter
     $decodedName =$product;
    $getproduct = "SELECT * FROM product WHERE imgname='$product'";
    $runquery = mysqli_query($conn, $getproduct);
    if ($rowproduct = mysqli_fetch_assoc($runquery)) {
        $productid = $rowproduct['id'];
        $productname = $rowproduct['name'];
        $productcatagory = $rowproduct['catagory'];
        $productdescription = $rowproduct['description'];
        $productprice = $rowproduct['Price'];
        $imgname = ""; // Set image name
    }
}

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];
    $imgname = $_POST['imgname'];

    // Add the product to the cart
    $userid = $_SESSION['user'];
    $insert_cart_query = "INSERT INTO cart (userid, productid, name, quantity, price) VALUES ('$userid', '$product_id', '$product_name', '$product_quantity', '$product_price')";
    
    // Execute the query
    if (mysqli_query($conn, $insert_cart_query)) {
        // Redirect to the cart page or any other appropriate page
        header("Location: cart.php");
        exit();
    } else {
        // Handle error if the query fails
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <style>
        /* Your CSS styles */
    </style>
</head>
<body>
    <div class="container">
        <div class="product-details">
            <h3><?php echo $productname; ?></h3>
            <img id="oneimg" src="<?php echo $decodedName; ?>" alt="Product Image" style="height:200px;">
            <p>Price: <?php echo $productprice; ?></p>
            <div class="description">
                <h5><?php echo $productdescription; ?></h5>
            </div>
        </div>
    </div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="caption">
            <input type="hidden" name="product_id" value="<?php echo $productid; ?>">
            <input type="hidden" name="product_name" value="<?php echo $productname; ?>">
            <input type="hidden" name="product_price" value="<?php echo $productprice; ?>">
            <input type="hidden" name="imgname" value="<?php echo $imgname; ?>">
            <input type="hidden" name="product_quantity" value="1">
        </div>
        <input type="submit" class="btnaddtocart" value="Add to cart" name="add_to_cart" style="margin-left:130px;">
    </form>
    <!-- Rest of your HTML content -->
</body>
</html>
<?php 
ob_end_flush(); 