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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Order History</title>
</head>
<style>
    body{
        background-color: #efefef;
    }
</style>
<nav>

    <div class="logo">
        <h1>VintageVolumes</h1>
    </div>
    <div class="nav-links">

        <h3><a href="home.php"><i class="fa fa-home"></i></a></h3>
        <h3><a href="addproduct.php">Add Book</a></h3>
        <h3><a href="aboutus.php">About Us</a></h3>
        <h3><a class="current" href="historyorder.php">Order History</a></h3>


        <?php
        $sql = "SELECT * FROM `cart`";
        $result = mysqli_query($conn, $sql);
        $total_cart_items = mysqli_num_rows($result);
        ?>
        <h3 ><a href="cart.php"><i class="fas fa-shopping-cart "></i>Cart <span>(<?= $total_cart_items ?>)</span></a></h3>

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
<div class="shopping-cart">
        <table>
            <thead>
                <th>image</th>
                <th>name</th>
                <th>Email</th>
                <th>price</th>
                <th>quantity</th>
                <th>total price</th>
                <th>ISBN</th>
            </thead>
            <tbody>
                <?php





                $cart_query = mysqli_query($conn, "SELECT * FROM `tblorder` WHERE user_email = '$user_id'") or die('query failed');
                $grand_total = 0;

                if (mysqli_num_rows($cart_query) > 0) {
                    while ($fetch_cart = mysqli_fetch_assoc($cart_query)) {

                ?>
                        <tr>
                            <td><img src="Images/<?php echo $fetch_cart['image']; ?>" alt="" height="200"></td>
                            <td><?php echo $fetch_cart['title']; ?></td>
                            <td><?php echo $fetch_cart['user_email']; ?></td>
                            <td>R<?php echo $fetch_cart['price']; ?></td>
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                                    <input type="hidden" name="cart_title" value="<?php echo $fetch_cart['title']; ?>">

                                    <input type="number" min='1' name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                                    


                                </form>
                            </td>
                            <td>R<?php echo $sub_total = $fetch_cart['price'] * $fetch_cart['quantity']; ?></td>
                            <td><?php echo $fetch_cart['isbn']; ?></td>
                            
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
                    


                </tr>
            </tbody>
        </table>
        

        

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