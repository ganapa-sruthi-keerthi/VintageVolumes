<?php
    include 'DBConn.php';



    session_start();
    
    $user_id = $_SESSION['user'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="CSS/style.css">
    <title>AboutUs</title>
</head>
<style>
    body {
        background-color: #efefef;
        overflow: hidden;
        overflow-y: scroll;
        height: 100vh;
    }

    h1 {
        font-size: 3em;
        margin-top: 0;
        font-weight: 400;
    }
    h2{
        margin-top: 50px;
        font-size: 2em;
        font-weight: 300;
    }

    p {
        margin-bottom: 10px;
    }

    .about-us {
        width: 80%;
        margin: 0 auto;
    }
</style>
<nav>


    <div class="logo">
        <h1>VintageVolumes</h1>
    </div>
    <div class="nav-links">
        <h3><a href="home.php"><i class="fa fa-home"></i></a></h3>
        <h3><a href="addproduct.php">Add Book</a></h3>
        <h3><a class="current" href="AboutUs.php">About Us</a></h3>
        <h3><a href="historyorder.php">Order History</a></h3>
        
        <?php
           $sql = "SELECT * FROM `cart`";
           $result = mysqli_query($conn, $sql);
           $total_cart_items = mysqli_num_rows($result);
         ?>
        <h3><a href="cart.php" ><i class="fas fa-shopping-cart"></i>Cart <span>(<?= $total_cart_items?>)</span></a></h3>
        <h3><a href="index.php" name='Logout'>Logout</a></h3>
    </div>

</nav>

<body>
<div class="circle1"></div>
    <div class="circle2"></div>
    <div class="circle3"></div>
    <div class="circle4"></div>
    <div class="circle5"></div>
    <div class="circle6"></div>
    <div class="about-us">
        <h1>About Us</h1>
        <p>
            VintageVolumes is a second-hand textbook website for students. We help students save money on their textbooks by providing a platform where they can buy and sell used textbooks. We have a wide selection of textbooks available, and we offer competitive prices.
        </p>
        <p>
            We are committed to providing a safe and easy way for students to buy and sell textbooks. Our website is secure, that is there will be no direct contact between buyers and sellers, which will ensure a safe exchange of books and also knowledge. We also have a team of customer support representatives who are available to help you with any questions you may have.
        </p>
        <p>
            We believe that VintageVolumes is a valuable resource for students. We help students save money on their textbooks, and we also help them to reduce their environmental impact. When you buy a used textbook from VintageVolumes, you are helping to keep textbooks out of landfills.
        </p>
        <h2>Our Mission</h2>
        <p>
            Our mission is to make it easy,secure, and affordable for students to buy and sell used textbooks. We believe that everyone should have access to the textbooks they need to succeed in school, regardless of their financial situation.
        </p>
        <h2>Our Values</h2>
        <ul>
            <li>Best recycle is Book recycle</li>
            <li>Affordability</li>
            <li>Convenience</li>
            <li>Safety & Secure</li>
            <li>Customer Service</li>
        </ul>

        <h2>Our Team</h2>
        <p>
            Our team is made up of a group of dedicated individuals who are passionate about education and the environment. We are committed to providing the best possible service to our customers, and we are always looking for ways to improve our website and make it even better.
        </p>
        <ul>
            <li>Sruthi Keerthi</li>
            <li>Mamidi swaraj Chandra Reddy</li>
            <li>N Sai Sri Chandra</li>
        </ul>

        <h2> Get in Touch</h2>
        <p>
            If you have any questions or feedback, we would love to hear from you.
        </p>
            
        <p> 
            You can contact us by email at : <a href="mailto:vintagevolumes12@gmail.com">vintagevolumes12@gmail.com</a> 
        </p>

        <p>
            We hope you will join us on our mission to make education more affordable for everyone.
        </p>
        <p>
            Thank you for choosing VintageVolumes!
        </p>

    </div>

</body>

<script>
    //function for the green circles that will only show at a certain scroll-y axis
    window.onscroll = function() {
        var scrollTop = window.scrollY;
        var modal = document.querySelector(".circle7");
        var modal1 = document.querySelector(".circle7_1");
        var modal2 = document.querySelector(".circle7_2");
        var modal8 = document.querySelector(".circle8");
        var modal8_2 = document.querySelector(".circle8_2");
        var modal8_3 = document.querySelector(".circle8_3");
        var modal9 = document.querySelector(".circle9");
        var modal9_2 = document.querySelector(".circle9_2");
        var modal9_3 = document.querySelector(".circle9_3");
        var modal10 = document.querySelector(".circle10");
        var modal10_3 = document.querySelector(".circle10_3");
        var modal10_2 = document.querySelector(".circle10_2");
        var modal11 = document.querySelector(".circle11");
        var modal11_2 = document.querySelector(".circle11_2");
        var modal11_3 = document.querySelector(".circle11_3");
        var modal12 = document.querySelector(".circle12");
        var modal12_2 = document.querySelector(".circle12_2");
        var modal12_3 = document.querySelector(".circle12_3");
        var modal13 = document.querySelector(".circle13");
        var modal13_2 = document.querySelector(".circle13_2");
        var modal13_3 = document.querySelector(".circle13_3");
        //For circle 7
        if (scrollTop > 600) {

            modal.style.display = 'flex';
            modal1.style.display = 'flex';
            modal2.style.display = 'flex';

        } else {
            modal.style.display = 'none';
            modal1.style.display = 'none';
            modal2.style.display = 'none';
        }

        //For circle 8
        if (scrollTop > 1500) {

            modal8.style.display = 'flex';
            modal8_2.style.display = 'flex';
            modal8_3.style.display = 'flex';

        } else {
            modal8.style.display = 'none';
            modal8_2.style.display = 'none';
            modal8_3.style.display = 'none';
        }
        //For circle 9
        if (scrollTop > 2400) {

            modal9.style.display = 'flex';
            modal9_2.style.display = 'flex';
            modal9_3.style.display = 'flex';

        } else {
            modal9.style.display = 'none';
            modal9_2.style.display = 'none';
            modal9_3.style.display = 'none';
        }

        //For circle 10
        if (scrollTop > 3300) {

            modal10.style.display = 'flex';
            modal10_2.style.display = 'flex';
            modal10_3.style.display = 'flex';

        } else {
            modal10.style.display = 'none';
            modal10_2.style.display = 'none';
            modal10_3.style.display = 'none';
        }

        //For circle 11
        if (scrollTop > 4200) {

            modal11.style.display = 'flex';
            modal11_2.style.display = 'flex';
            modal11_3.style.display = 'flex';

        } else {
            modal11.style.display = 'none';
            modal11_2.style.display = 'none';
            modal11_3.style.display = 'none';
        }

        //For circle 12
        if (scrollTop > 5100) {

            modal12.style.display = 'flex';
            modal12_2.style.display = 'flex';
            modal12_3.style.display = 'flex';

        } else {
            modal12.style.display = 'none';
            modal12_2.style.display = 'none';
            modal12_3.style.display = 'none';
        }

        //For circle 13
        if (scrollTop > 6000) {

            modal13.style.display = 'flex';
            modal13_2.style.display = 'flex';
            modal13_3.style.display = 'flex';

        } else {
            modal13.style.display = 'none';
            modal13_2.style.display = 'none';
            modal13_3.style.display = 'none';
        }

    };
</script>

</html>
