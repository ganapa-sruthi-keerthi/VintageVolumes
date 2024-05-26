<?php
include("DBConn.php");

include 'loadBookstore.php';
global $conn;
session_start();

$user_id = $_SESSION['user'];

// Query to check if there are new books
$sql_check_newbooks = "SELECT COUNT(*) as count FROM newbooks";
$result_check_newbooks = $conn->query($sql_check_newbooks);
$row_check_newbooks = $result_check_newbooks->fetch_assoc();
$new_books_count = $row_check_newbooks['count'];



if(isset($_POST['drop_books'])){
    mysqli_query($conn, "DROP TABLE tblbooks ") or die('query failed');

    $success_msg[] = "All books removed!";
}

if (isset($_POST['pay_amount'])) {
    $book_id = $_POST['book_id'];
    $sql = "INSERT INTO tblbooks (img, title, author, price, isbn, quantity, added_by)
            SELECT img, title, author, price, isbn, quantity, added_by FROM newbooks WHERE id = $book_id";
    $conn->query($sql);
    $sql = "DELETE FROM newbooks WHERE id = $book_id";
    $conn->query($sql);
    $success_msg[] = "Payment successful, book moved to main catalog!";
}


?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="CSS/style.css">

    <title>Admin Page</title>
    <style>
        .form-box {
            margin-top: 50px;
            width: 40%;
        }

        .box {
            align-items: center;
        }

        .admin_header {
            text-align: center;
        }

        .sub_heading {
            text-align: center;
        }

        h4 {
            text-align: center;
        }

        input {

            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 5px;
            border-radius: 5px;
            width: 100%;

        }

        input:hover {
            border-color: #aaa;
        }

        .log-out {
            position: absolute;
            top: 0;
            right: 22px;
            height: 25px;
        }
        .log-out:hover{
            opacity: .8;
        }

        body {
            background-color: #ccc;
            width: 100%;
        }

        .btn {
            text-decoration: none;
        }

        .book-details {
            margin-top: 20px;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
        }
        .payment-btn {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #0c4a3c;
            color: white;
            text-align: center;
            border-radius: 5px;
            cursor: pointer;
        }
        .payment-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="circle1"></div>
    <div class="circle2"></div>
    <div class="circle3"></div>
    <div class="circle4"></div>
    <div class="circle5"></div>
    <div class="circle6"></div>
    <div class="circle7"></div>
    <div class="container">
        <div class="form-box box">

            <form action="about.php" method="post" autocomplete="off">
                <h1 class="admin_header">ADMIN</h1>

                <a href="index.php" class="btn log-out">Logout</a><br><br>

                <h3 class="sub_heading">Pending Users:</h3>
                <h4>
                    <?php
                    $sql = "SELECT * FROM tbluser WHERE ULevel = 'pending'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {

                            echo "<hr>Name: " . $row['FName'] . "<br>" . " Surname:   " . $row['LName'] . "<br>" . "Email: " . $row['Email'] . "<br>";
                        }
                    }

                    ?>
                </h4>

                <hr>
                <h3 class="sub_heading">Update User:</h3>
                <input type="text" name="user_update" placeholder="Enter User Email to Update"><br>
                <input type="submit" name="update" value="Update" class="btn">



                <h3 class="sub_heading">Add User:</h3>
                <input type="text" name="name" placeholder="Name" autocomplete="off"><br>
                <input type="text" name="surname" placeholder="Surname" autocomplete="off"><br>
                <input type="email" name="email" placeholder="Email" autocomplete="off"><br>
                <input type="password" name="password" placeholder="Password" autocomplete="off"><br>
                <input type="submit" name="register" , value="Register" class="btn">

                <h3 class="sub_heading">Delete User:</h3>
                <input type="text" name="user_delete" placeholder="Enter Email to delete user">
                <input type="submit" name="button_delete" value="Delete" class="btn">


                <h3 class="sub_heading">New Books Added by Users:</h3>
                <div class="new-books-alert" style="display: <?php echo $new_books_count > 0 ? 'block' : 'none'; ?>;">
                    <?php
                    $sql = "SELECT n.id, n.title, n.author, n.price, n.isbn, n.quantity, u.FName, u.LName, u.Email 
                            FROM newbooks n 
                            JOIN tbluser u ON n.added_by = u.ID";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<p>Book Title: " . $row['title'] . "<br>Author: " . $row['author'] . "<br>Price: " . $row['price'] . "<br>ISBN: " . $row['isbn'] . "<br>Quantity: " . $row['quantity'] . "<br>Added by: " . $row['FName'] . " " . $row['LName'] . " (" . $row['Email'] . ")</p>";
                            echo '<form action="about.php" method="post" style="display:inline-block;">
                                    <input type="hidden" name="book_id" value="' . $row['id'] . '">
                                    <input type="submit" name="pay_amount" value="Pay Amount" class="payment-btn">
                                  </form>';
                        }
                    }
                    ?>
                </div>

                <hr>

                <h3 class="sub_heading">Load BookStore: </h3>
                <input type="submit" name="load_books" value="Load Books" class="btn">
                <input type="submit" name="drop_books" value="Drop Books" class="btn">
            </form>
        </div>
    </div>

</body>


</html>

<?php



//UPDATE USER START=======================================================
// Check if the "update" POST request is set
if (isset($_POST['update'])) {

    // Check if the "user_update" POST request is empty
    if (empty($_POST['user_update'])) {
        // Display an error message
        
        $warning_msg[]= 'Enter user email!';
    } else {
        // Get the user email from the POST request
        $user_update = $_POST['user_update'];

        // Create an SQL query to select the user from the database
        $sql = "SELECT * FROM tbluser WHERE Email = '$user_update'";

        // Execute the query
        $result = $conn->query($sql);

        // Check if the user exists in the database
        if ($result->num_rows === 0) {
            // Display an error message
            
            $warning_msg[]= 'User does not exist!';
            
        } else {
            // Create an SQL query to update the user's level
            $sql = "UPDATE tbluser SET ULevel = 'user' WHERE Email = '$user_update'";

            // Execute the query
            $result = $conn->query($sql);

           $success_msg[]= 'User permision granted!';
           
        }
    }
}
//UPDATE USER END  ================================================



// ADD USER START ============================================
//empty is true when the input is NOT empty
$empty = "full";

//Saving to the database
if (isset($_POST["register"])) {

    $fname = $_POST['name'];
    $lname = $_POST["surname"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($_POST['name']) || empty($_POST['surname']) || empty($_POST['email']) || empty($_POST['password'])) {

        
        $warning_msg[]='Enter all infomation first!';

        //This is false if the inputs are empty
        $empty = "empty";
    }


    if ($empty == "full") {

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO tbluser(FName,LName,Email,Password,ULevel) VALUES('$fname','$lname','$email','$hash','pending')";

        if ($conn->query($query) === TRUE) {
            
            $success_msg[] = 'New user created!';
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }

        
        
    } else {
        $warning_msg[] = 'Enter all fields fist!';
    }
}
// ADD USER END ============================================


// Delete USER START ========================================
if (isset($_POST['button_delete'])) {

    if (empty($_POST['user_delete'])) {
        $warning_msg[]='Enter email to delete';
       
    } else {
        $user_delete = $_POST['user_delete'];

        // Create an SQL query to select the user from the database
        $sql = "SELECT * FROM tbluser WHERE Email = '$user_delete'";

        // Execute the query
        $result = $conn->query($sql);

        // Check if the user exists in the database
        if ($result->num_rows === 0) {
            
        } else {
            // Delete the user from the database
            $sql = "DELETE FROM tbluser WHERE Email = '$user_delete'";
            $result = $conn->query($sql);

            $success_msg[] = 'User '.$user_delete.' has been removed';
           
        }
        
        
    }
}

// Delete USER END ==========================================


// Close the database connection
$conn = null;
?>
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