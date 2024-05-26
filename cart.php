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
    <title>Cart</title>
    <style>
        body {
            background-color: #efefef;
        }

        .field {
            display: flex;
            width: 100%;
            margin-top: 20px;
        }

        .field .btn {
            width: 11%;
            font-size: 20px;
        }

        .btn {

            margin: auto;
        }
    </style>
</head>
<nav>

    <div class="logo">
        <h1>VintageVolumes</h1>
    </div>
    <div class="nav-links">

        <h3><a href="home.php"><i class="fa fa-home"></i></a></h3>
        <h3><a href="addproduct.php">Add Book</a></h3>
        <h3><a href="aboutus.php">About Us</a></h3>
        <h3><a href="historyorder.php">Order History</a></h3>


        <?php
        $sql = "SELECT * FROM `cart`";
        $result = mysqli_query($conn, $sql);
        $total_cart_items = mysqli_num_rows($result);
        ?>
        <h3><a href="cart.php"><i class="current fas fa-shopping-cart "></i>Cart <span>(<?= $total_cart_items ?>)</span></a></h3>

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
    <!-- Shopping cart Start -->
    <?php



    if (isset($_POST['update_cart'])) {



        $update_quantity = $_POST['cart_quantity'];
        $update_id = $_POST['cart_id'];
        mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id'") or die('query failed');



        $cart_product_title = $_POST['cart_title'];
        $cart_product_quanitiy = $_POST['cart_quantity'];

        // This code selects all columns from the `tblBooks` table
        $sql = "SELECT * FROM tblBooks WHERE title = '$cart_product_title'";
        // This code executes the SQL statemtnt and stores the results in a variable called `$result`
        $result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($result);

        $total_stock =  ($row['quantity'] - $cart_product_quanitiy);

        $update_quantitys = mysqli_query($conn, "UPDATE `tblBooks` SET quantity = '$total_stock' where title = '$cart_product_title' ");

        $success_msg[] = 'cart quantity updated successfully!';
    }

    if (isset($_GET['remove'])) {
        $remove_id = $_GET['remove'];
        $success_msg[] = "Item Removed!";

        mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');
    }

    if (isset($_GET['delete_all'])) {

        mysqli_query($conn, "DELETE FROM `cart` WHERE user_email = '$user_id'") or die('query failed');
        $success_msg[] = "All Items Removed!";
    }

    if (isset($_POST['check-out'])) {

        $cart_id = $_POST['cart_id'];
        $cart_user_email = $_POST['cart_user_email'];
        $cart_title = $_POST['cart_title'];
        $cart_price = $_POST['cart_price'];
        $cart_image = $_POST['cart_image'];
        $cart_quantity = $_POST['cart_quantity'];
        $cart_author = $_POST['cart_author'];
        $cart_isbn = $_POST['cart_isbn'];

        mysqli_query($conn, "INSERT INTO `tblorder`(id,user_email,title,price,image,quantity,author,isbn) VALUES ('$cart_id','$cart_user_email','$cart_title','$cart_price','$cart_image','$cart_quantity','$cart_author','$cart_isbn')") or die('query failed');

        //To remove the content from the Cart after checkout is clicked
        mysqli_query($conn, "DELETE FROM `cart` WHERE user_email = '$user_id'") or die('query failed');
        $success_msg[] = "Order Placed";
    }

    if (isset($_GET['Continue-Shopping'])) {
        header('location:home.php');
    }

    ?>

    <div class="shopping-cart">
        <table>
            <thead>
                <th>image</th>
                <th>name</th>
                <th>price</th>
                <th>quantity</th>
                <th>total price</th>
                <th>action</th>
            </thead>
            <tbody>
                <?php





                $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_email = '$user_id'") or die('query failed');
                $grand_total = 0;

                if (mysqli_num_rows($cart_query) > 0) {
                    while ($fetch_cart = mysqli_fetch_assoc($cart_query)) {

                ?>
                        <tr>
                            <td><img src="Images/<?php echo $fetch_cart['image']; ?>" alt="" height="200"></td>
                            <td><?php echo $fetch_cart['title']; ?></td>
                            <td>R<?php echo $fetch_cart['price']; ?></td>
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                                    <input type="hidden" name="cart_title" value="<?php echo $fetch_cart['title']; ?>">

                                    <input type="number" min='1' name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                                    <input type="submit" name="update_cart" value="Update" class="btn">


                                </form>
                            </td>
                            <td>R<?php echo $sub_total = $fetch_cart['price'] * $fetch_cart['quantity']; ?></td>
                            <td><a class="btnDel" href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('Remove item from cart?');">Remove</a></td>
                        </tr>
                <?php
                        $grand_total += intval($sub_total);
                    };
                } else {
                    echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">no item added</td></tr>';
                }
                ?>

                <tr class="table-bottom">

                    <td colspan="4">Grand Total :</td>

                    <td>R<?php echo $grand_total; ?></td>
                    <td><a class='btnDel' href="cart.php?delete_all" onclick="return confirm('Delete all from cart?');">Delete all</a></td>


                </tr>
            </tbody>
        </table>
        <!-- for checkout button -->
        <?php
        $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_email = '$user_id'") or die('query failed');


        if (mysqli_num_rows($cart_query) > 0) {
            while ($fetch_cart = mysqli_fetch_assoc($cart_query)) {

        ?>
                <form action="" method="post">
                    <div class="field">
                        <input type="submit" name="check-out" value="Checkout" class="btn" style="background-color: rgb(8, 138, 182);">
                    </div>
                    <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                    <input type="hidden" name="cart_title" value="<?php echo $fetch_cart['title']; ?>">
                    <input type="hidden" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                    <input type="hidden" name="cart_author" value="<?php echo $fetch_cart['author']; ?>">
                    <input type="hidden" name="cart_price" value="<?php echo $fetch_cart['price']; ?>">
                    <input type="hidden" name="cart_user_email" value="<?php echo $fetch_cart['user_email']; ?>">
                    <input type="hidden" name="cart_image" value="<?php echo $fetch_cart['image']; ?>">
                    <input type="hidden" name="cart_isbn" value="<?php echo $fetch_cart['isbn']; ?>">

                </form>
        <?php

            };
        }
        ?>
        <!-- checkout button end -->

        <div class="cart-btn">
            <a href="cart.php?Continue-Shopping" class="btnCheck ">Continue Shopping</a>
        </div>

    </div>
    <!-- Shopping cart end -->
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