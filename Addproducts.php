<?php
ob_start();
session_start();

 include 'adminbar.php';
 include 'connection.php';
 if(!isset($_SESSION['loggedin'])|| $_SESSION['loggedin']!==true){
  header("Location:loginpage.html");
 }
 $result=null;
if (isset($_POST['submit'])) 
{
    $name=$_POST['name'];
    $catagory=$_POST['catagory'];
    $description=$_POST['description'];
    $quantity=$_POST['quantity'];
    $price=$_POST['price'];
    $filename = $_FILES["uploadfile"]["name"];  
    $fileextension=strtolower(pathinfo($filename,PATHINFO_EXTENSION));
    $allowedextension=array("jpg","jpeg","png");
    if(in_array($fileextension,$allowedextension)){
     $new_img_name=$filename;
     $check="SELECT * FROM product WHERE name='$name'";
    $checkresult = $conn->query($check);
    if ($checkresult->num_rows > 0) {
       
        echo "<script>alert('The product already exists !')</script>";
    } else {
     $insertSql = "INSERT INTO product(name, catagory, description, quantity, price, imgname) VALUES ('$name', '$catagory', '$description',$quantity, $price, '$new_img_name')";
   if ($conn -> query ($insertSql)) 
    {
        $result="<h2>*******Data insert success*******</h2>";
        $tempname = $_FILES["uploadfile"]["tmp_name"];   
        $folder = "".$filename;

        move_uploaded_file($tempname, $folder);
    }
    }}
 else{
    echo "<script>alert('The extension is not allowed');</script>";
 }

} 
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
body
{
  margin-left: 14%;
  margin-top: 7%;
  background:white;
}
.c1 h1
  {
    margin-bottom:2%;
    margin-top:-2%;
  }
  .line
        {
            height: 1px;
            max-width:220px;
            color: grey;
            opacity: 20%;
            margin-top: -2%;
            margin-bottom:3%;
            /* margin-left:14%;  */
        }

  label
  {
    font-size: 1.2em;
    margin-bottom: 10px; /* Increase space below labels */
  }
  .mb-3
  {
    margin-bottom:10px;
  }
  .container {
            max-width: 400px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            background-color: #ffffff;
            height:550px;
            
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            height:40px;
            margin-left:10px;
            border:1px solid green;
            border-radius:10px;
            margin-top:5px;
        }

        .sbtn
        {
          margin-top:15px;
          padding: 5px 5px;
          font-size:18px;
        }
        .choose
        {
          padding:5px 5px;
          font-size:16px;
          margin-top: -50px;
        }
        label{
          font-weight:bold;
        }
        
        button[type="submit"]{
          font-weight:bold;
          border-radius:10px;

        } 
        button[type="submit"]:hover{
          background:green;
          color:white;
          font-weight:bold;
          
        } 
        .container:hover{
          box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
</style>
<body>
<div class="c1">
          <h1>Add Product</h1>
          <hr class="line">
        </div> 
    <div class="container" style="margin-left:300px; margin-top:-75px;background:lightgreen; width:500px;" >
      <?php echo $result;?>
      
         <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" >
  <div class="mb-3">
    <label for="exampleInputName" class="form-label">Product Name</label>
    <input type="text" name="name" class="form-control" id="exampleInputName" placeholder="  Enter Product Name" required>
  </div>
  <div class="mb-3">
    <label for="exampleInputType" class="form-label">Category</label>
    <input type="text" name="catagory"  class="form-control" id="exampleInputType" placeholder="  Enter Product Category" required>
  </div>
  <div class="mb-3">
    <label for="exampleInputDescription" class="form-label">Description</label>
    <input type="text" name="description" class="form-control" id="exampleInputDescription" placeholder="  Enter Product  Description" required>
  </div>
  <div class="mb-3">
    <label for="exampleInputQuantity" class="form-label">Quantity</label>
    <input type="number" name="quantity" class="form-control" id="exampleInputQuantity" placeholder="  Enter Product Quantity" required>
  </div>
  <div class="mb-3">
    <label for="exampleInputPrice" class="form-label">Price</label>
    <input type="Number" name="price" class="form-control" id="exampleInputPrice" placeholder="  Enter Product Price" required>
  </div>
  <div class="mb-3">
        <label for="uploadfile" class="form-label" > Image</label><br><br>
        <input class="choose" type="file" name="uploadfile" style=" margin-left:100px;" required >
    </div>
  <button type="submit" name="submit" class="sbtn"style="margin-left:300px;">Submit</button>
</form>
    </div>
  <br>
  <br>
  <br>
  <!-- <img src="Photoes/addprod.jpg" style="height:300px; width:300px;"> -->
</body>
</html>