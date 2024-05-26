<?php

include("DBConn.php");


?>
<?php
// Connect to the database
global $conn;

session_start();

// Check if the form was submitted
// This checks if the submit button was clicked
if (isset($_POST['submit'])) {

    // Get the username and password from the POST request
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Check if the username and password are correct
    // This query selects the user from the database where the email is equal to the username
    $sql = "SELECT * FROM tbluser WHERE Email = '$username'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if the user exists in the database
    // This checks if the number of rows returned by the query is equal to 1
    if (mysqli_num_rows($result) == 1) {

        // Get the user from the database
        $logged_in_user = mysqli_fetch_assoc($result);

        $_SESSION['user'] = $logged_in_user['Email'];

        // Check if the password is correct
        // This function compares the password entered by the user to the password stored in the database
        if (password_verify($password, $logged_in_user['Password'])) {
// Set the current user session to the logged in user
            

            // Check if the user is a user
            if ($logged_in_user['ULevel'] == "user") {

                // Redirect the user to the home page
                header("location:home.php");
            }
            if ($logged_in_user['ULevel'] == "admin") {

                header("location:about.php");
            }
            if ($logged_in_user['ULevel'] == "pending") {

                header("location:AdminValidate.php");
                
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<style>
    body{
        overflow: hidden;
    }
    .h{
        color: #3e8f7d2e;
    }
    .heading1{
        position: absolute;
        font-size: 15em;
        top: -97px;
    }
    .heading2{
        position: absolute;
        font-size: 15em;
        top:70px;
    }
    .heading3{
        position: absolute;
        font-size: 15em;
        top: 237px;
    }
    .heading4{
        position: absolute;
        font-size: 15em;
        top: 404px;
    }
    .heading5{
        position: absolute;
        font-size: 15em;
        top: 571px;
    }
    .heading6{
        position: absolute;
        font-size: 15em;
        top: 738px;
    }
</style>

<body>

    <div class="container">
        <h1 class="heading heading1 h">VintageVolumes</h1>
        <h1 class="heading heading2 h">VintageVolumes</h1>
        <h1 class="heading heading3 h">VintageVolumes</h1>
        <h1 class="heading heading4 h">VintageVolumes</h1>
        <h1 class="heading heading5 h">VintageVolumes</h1>
        <h1 class="heading heading6 h">VintageVolumes</h1>
        
        <!-- Wrap the login form with a div element with a class of "card" -->
        <div class="box form-box">
            <Header>Login</Header>
            <form class="login_details" action="index.php" method="post">

                <input type="text" name="username" placeholder="Email" required class="field ">
                <input type="password" name="password" placeholder="Password" required class="field ">

                <div class="field">
                    <input type="submit" value="Login" name="submit" class="btn">
                </div>

                <p >Not registered? <a href="Register.php">Create an account</a></p>
            </form>
        </div>
    </div>
</body>

</html>