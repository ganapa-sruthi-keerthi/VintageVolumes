<?php

include 'DBConn.php';

session_start();

$user_id = $_SESSION['user'];



// Button clicks

if (isset($_POST['add_to_cart'])) {

    $product_title = $_POST['product_title'];
    $product_author = $_POST['product_author'];
    $product_price = $_POST['product_price'];
    $product_isbn = $_POST['product_isbn'];
    $product_image = $_POST['product_image'];
    $product_quanttity = $_POST['product_quantity'];

    


    // This code selects all columns from the `tblBooks` table
    $sql = "SELECT * FROM tblBooks WHERE title = '$product_title'";
    // This code executes the SQL statemtnt and stores the results in a variable called `$result`
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);

    $total_stock = ($row['quantity'] - $product_quanttity);

    if ($product_quanttity > $row['quantity']) {
        // Add a warning message to the array.
        $info_msg[] = 'Only ' . $row['quantity'] . ' stock is left ';
    } else {

        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE title ='$product_title' AND user_email = '$user_id'") or die('query failed');
        //If product is already in the cart
        if (mysqli_num_rows($select_cart) > 0) {

            $warning_msg[] = "Product already added to cart!";
        } else {
            //If not add product to the cart
            mysqli_query($conn, "INSERT INTO `cart`(user_email,title,price,image,quantity,author,isbn) VALUES ('$user_id','$product_title','$product_price','$product_image','$product_quanttity','$product_author','$product_isbn')") or die('query failed');


            $update_quantity = mysqli_query($conn, "UPDATE `tblBooks` SET quantity = '$total_stock' where title = '$product_title' ");
            $success_msg[] = "Product added to cart!";
        }
    }
}

if (isset($_POST['Logout'])) {
    unset($user);
    session_destroy();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="CSS/style.css">
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <style>
        body {
            background-color: #efefef;
        }

        .btn-quantity {
            color: white;
            width: 25%;
            border-radius: 5px;
            text-align: center;
            background: #0c4a3c;
            border: 0;
            color: #fff;
            padding: 5px;
            
            
        }
         
        
    </style>
</head>

<nav>

    <div class="logo">
        <h1>VintageVolumes</h1>
    </div>
    <div class="nav-links">

        <h3><a class="current" href="home.php"><i class="fa fa-home"></i> </a></h3>
        <h3><a class="book" href="addproduct.php"> Add Book</a></h3>
        <h3><a href="aboutus.php">About Us</a></h3>
        <h3><a href="historyorder.php">Order History</a></h3>
        <?php
        $sql = "SELECT * FROM `cart`";
        $result = mysqli_query($conn, $sql);
        $total_cart_items = mysqli_num_rows($result);
        ?>
        <h3><a href="cart.php"><i class="fas fa-shopping-cart"></i>Cart <span>(<?= $total_cart_items ?>)</span></a></h3>
        <h3><a href="index.php" name='Logout'>Logout </a></h3>

    </div>

</nav>

<body>

    <div class="circle1"></div>
    <div class="circle2"></div>
    <div class="circle3"></div>
    <div class="circle4"></div>
    <div class="circle5"></div>
    <div class="circle6"></div>
    <div class="circle7"></div>
    <div class="circle7_1"></div>
    <div class="circle7_2"></div>
    <div class="circle8"></div>
    <div class="circle8_2"></div>
    <div class="circle8_3"></div>
    <div class="circle9"></div>
    <div class="circle9_2"></div>
    <div class="circle9_3"></div>
    <div class="circle10"></div>
    <div class="circle10_2"></div>
    <div class="circle10_3"></div>
    <div class="circle11"></div>
    <div class="circle11_2"></div>
    <div class="circle11_3"></div>
    <div class="circle12"></div>
    <div class="circle12_2"></div>
    <div class="circle12_3"></div>
    <div class="circle13"></div>
    <div class="circle13_2"></div>
    <div class="circle13_3"></div>

    <h1 class="heading">Available Textbooks </h1>

    <div class="container-home contain">

        <?php
        // Check if the books table exists
        $sql = "SHOW TABLES LIKE 'tblBooks'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {

            // This code selects all columns from the `tblBooks` table
            $sql = "SELECT * FROM tblBooks ";
            // This code executes the SQL statemtnt and stores the results in a variable called `$resul`
            $result = mysqli_query($conn, $sql);
            //Checks to see if the `tblBooks` table contains any rows
            if (mysqli_num_rows($result) > 0) {
                // This code enters the `while` loop if the `tblBooks` table contains any rows.
                while ($row = mysqli_fetch_assoc($result)) {

        ?>
                    <form method="post" class="boxx" action="">
                        <img src="Images/<?php echo $row['img']; ?>">
                        <div class="title"><?php echo $row['title']; ?></div>
                        <div class="author"><?php echo $row['author']; ?></div>
                        <div class="isbn"><?php echo $row['isbn']; ?></div>
                        <div class="price">R<?php echo $row['price']; ?></div>
                        <input type="number" min="1" name="product_quantity" value="1">

                        <input type="hidden" name="product_image" value="<?php echo $row['img']; ?>">
                        <input type="hidden" name="product_title" value="<?php echo $row['title']; ?>">
                        <input type="hidden" name="product_author" value="<?php echo $row['author']; ?>">
                        <input type="hidden" name="product_isbn" value="<?php echo $row['isbn']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $row['price'] ?>">
                        

                        
                        <?php if($row['quantity'] <= 0){   ?>
                        <input style="user-select: none; opacity: 0.5;pointer-events: none;" type="submit" value="Add To Cart" name="add_to_cart" class="btn" >
                        <?php }else{?>
                            <input type="submit" value="Add To Cart" name="add_to_cart" class="btn" >
                            <?php } ?>   
                        <br>
                        <?php if ($row['quantity'] >= 5) { ?>
                            <span class="btn-quantity"><i class="fas fa-check"></i> in stock</span>
                        <?php } elseif ($row['quantity'] <= 0 ) { ?>
                            <span class="btn-quantity" style="color: white; background-color: orange;"><i class="fas fa-times"></i> out of stock</span>
                        <?php } else { ?>
                            <span class="btn-quantity" style="color: white; background-color: red;">hurry, only <?= $row['quantity']; ?> left</span>
                        <?php } ?>
                        
                        

                    </form>
        <?php


                }
            } else {
                echo "There are currently no books available";
            }
        } else {

            // The books table does not exist, so we can't query it
            echo "The books table does not exist";
        }

        ?>



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

<!-- PopUp message Start -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
if (isset($success_msg)) {
    foreach ($success_msg as $success_msg) {
        echo '<script>swal("' . $success_msg . '", "", "success");</script>';
    }
}
if (isset($warning_msg)) {
    foreach ($warning_msg as $warning_msg) {
        echo '<script>swal("' . $warning_msg . '", "", "warning");</script>';
    }
}
if (isset($info_msg)) {
    foreach ($info_msg as $info_msg) {
        echo '<script>swal("' . $info_msg . '", "", "info");</script>';
    }
}
if (isset($error_msg)) {
    foreach ($error_msg as $error_msg) {
        echo '<script>swal("' . $error_msg . '", "", "error");</script>';
    }
}

?>
<!-- PopUp message End -->





</html>