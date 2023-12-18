<?php 
include  'Header.php';
include  'dbconnect.php';
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect the user to the login page
    header('Location: login.php');
    exit;
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        main {
    max-width: 1500px;
    width: 95%;
    margin: 30px auto;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin: auto;
}

.card-container {
    flex: 1 1 210px;
    text-align: center;
    margin: 20px;
}

.card {
    border: 2px solid yellow;
    height: 270px;
    width:180px; 
    margin:40px;
    background:whitesmoke;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.card .image {
    height: 60%;
    margin-bottom: 20px;
}

.card .image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.card .caption {
    margin-top:-52px;
    padding-left:13px;
    text-align: left;
    line-height:20px;
    word-break:normal;
   font:arial;
    font-weight: bold;
    height: 25%;
    background:whitesmoke;
    
}

.card button {
    border:1px solid green;
    border-radius:20px;
   
    width: 70%;
    cursor: pointer;
    margin-top:-1em;
    margin-left:40px;
    font-weight: bold;
   
    position: relative;
    height: 280%;
    background:whitesmoke;
}
.buttons{
    width:76%;
    background:whitesmoke;
}

.card button:before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    bottom:0;
    width: 0;
    background-color:whitesmoke;
    transition: all 0.5s;
    margin: 0;
}
.caption .price{
    margin-top:-10px;
    color:red;
    margin-left:5px;
    background:whites
}

.card button:after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    width: 0;
    background-color:green;
    transition: all 0.5s;
}

.card button:hover::before {
    width: 5%;
}

.card button:hover::after {
    width: 6%;
}
.buttons{
    display:grid;
    grid-template-columns:110% 80%;
    background:whitesmoke; 
    
}

       
       
    </style>
</head>
<body>
<main>  
         <?php 
            $query ="SELECT * FROM productdatabase ORDER BY id DESC";
            $result=mysqli_query($conn,$query);
             if(mysqli_num_rows($result)>0){
                  while($images=mysqli_fetch_assoc($result)){ 
                    // var_dump($images); ?>

               
                    
                        <div class="card"> 
                               <div class="image"> 
                                  <img id="image-frd" src="../ThirdEye/<?=$images['Picture']?>">
                              </div>
                               <div class="caption">
                                <p class="ProductName"><?php echo $images['ProductName']  ?></p>
                                 <p class="price">RS.<?php echo $images['Price']  ?></p>
                               </div>
                               <div class="buttons">
                                         
                                          <!-- <div class="viewingdetails"> <button class="details" id="viewdetails"><a href='Details.php'
                                        >
                                    View Details</a></button></div> -->
                                    <button class="details" onclick="redirectToDetails('<?php echo $images["Id"]; ?>')">View Details</button>



                               </div>
                        
                             </div>
              
               
                 

               <?php
                }}

            ?>
            <script>
                        function redirectToDetails(productId) {
                        window.location.href = "Details.php?id=" + productId;
                    }
            </script>

    </main>
</body>
</html>