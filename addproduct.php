<?php
include 'DBConn.php';

session_start();

$user_id = $_SESSION['user'];

?>

<?php include "DbConn.php";


if (isset($_POST['add_book'])) {

    $title = $_POST['title'];
    $title = filter_var($title, FILTER_SANITIZE_STRING);

    $author = $_POST['author'];
    $author = filter_var($author, FILTER_SANITIZE_STRING);

    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);

    $isbn = $_POST['isbn'];
    $isbn = filter_var($isbn, FILTER_SANITIZE_STRING);

    $stock = $_POST['stock'];
    $stock = filter_var($stock, FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $rename = $user_id;
    $image_size = $_FILES['image']['size'];
   



    if ($image_size > 2000000) { // Adjust the image size limit as per your requirement
        $warning_msg[] = 'Image size is too big';
    } else {

        $sql = "INSERT INTO newbooks (img, title, author, price, isbn, quantity, added_by)
            VALUES ('$image','$title','$author',$price,'$isbn','$stock', '$user_id');";
        $conn->query($sql);

        $success_msg[] = "Book Added!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>AddProduct</title>
    <style>
        body {
            font-family: monospace;
            overflow: hidden;
            overflow-y: scroll;
            background-color: #efefef;

        }
        .container{
            justify-content: flex-start;
        }
        .input{
            width: 50%;
        }
        p{
            font-size: 20px;
        }
        .input-img{
            background-color: #d3d3d3;
        }
        p span{
            color: red;
        }
    </style>
</head>
<nav>

    <div class="logo">
        <h1>VintageVolumes</h1>
    </div>
    <div class="nav-links">

        <h3><a href="home.php"><i class="fa fa-home"></i></a></h3>
        <h3><a class="current" href="addproduct.php">Add Book</a></h3>
        <h3><a href="aboutus.php">About Us</a></h3>

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
        <!-- Admin add product -->

        <div class="container">
            <div class="textbook-box ">

                <h1 class="heading"> Add textbooks: </h1>

                <form action="" method="post" enctype="multipart/form-data">
                    
                    <p>Title: <span>*</span></p>

                    <input type="text" name="title" required maxlength="100" placeholder="enter book title" class="input">

                    <p>Author: <span>*</span></p>
                    <input type="text" name="author" required maxlength="100" placeholder="enter authour" class="input">

                    <p>Price: <span>*</span></p>

                    <input type="number" name="price" required maxlength="100" placeholder="enter book Price" min="0" max="9999999999" class="input">


                    <p>ISBN number:<span>*</span></p>
                    <input type="text" name="isbn" required maxlength="13" placeholder="enter ISBN number" min="0" max="13" class="input">

                    <p>Stock: <span>*</span></p>
                    <input type="number" name="stock" required maxlength="10" placeholder="enter stock " min="0" max="9999999999" class="input">

                    <p>Book Image: <span>*</span></p>
                    <input type="file" name="image" required accept="image/*" class="input input-img">
                    <br>
                    <input type="submit" value="Add book" name="add_book" class="btn">

                </form>
            </div>
        </div>
    </body>

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