<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
footer {
    background-color: gray:
    color: white;
    padding: 20px 0;
    text-align: center;
    position: absolute;
    bottom: 0;
    width: 100%;
    transform: translate(0%,600%); 
}



</style>
<body>
    

<footer>
    <div class="container">
        <div class="footer-content">
            <div class="c1">
                <h2>About Us</h2>
                <p>@Velocity Arena</p>
            </div>
            <div class="c2">
                <h2>Contact Us</h2>
                <p>Kathmandu Nepal</p>
                <p>velocityarena@com</p>
                <p>Phone: +977 0111111</p>
            </div>
            <div class="c3">
                <h2>Services</h2>
                <p>Futsal Accessories</p>
                <p>Cricket Accessories</p>
                <p>Ground Booking</p>
            </div>
            <div class="c4">
                <h2>Training</h2>
                <p>College Training</p>
                <p>School Training</p>
                <p>Personal Training</p>
            </div>
        </div>
        <div class="foot">
            <p class="footer-text">@ALL rights reserved with Velocity Arena</p>
        </div>
    </div>
</footer>

</body>
</html> -->





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
/* Style for the footer */
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
<body>
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
