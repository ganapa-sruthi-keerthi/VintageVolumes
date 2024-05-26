<?php

include("DBConn.php");
$fname = "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="CSS/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    
  
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
        <div class="box form-box">
        <Header>Register</Header>
            
                <form action="Register.php" method="post" class="form">

                    <input type="text" name="name" placeholder="Name" required class="field">
                    <input type="text" name="surname" placeholder="Surname" required class="field">
                    <input type="text" name="email" placeholder="Email" required class="field">
                    <input type="password" name="password" placeholder="Password" required class="field"> 
                    
                    <div class="field">
                    <input type="submit" name="register" value="Register" class="btn">
                    </div>

                    <p >Already registered? <a href="index.php">Sign in</a></p>
                </form>
            
        </div>
    </div>
</body>

</html>


<?php

global $conn;

//empty is true when the input is NOT empty
$empty = "full";

//Saving to the database
if (isset($_POST["register"])) {

    $fname = $_POST['name'];
    $lname = $_POST["surname"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($_POST['name']) || empty($_POST['surname']) || empty($_POST['email']) || empty($_POST['password'])) {

        //This is false if the inputs are empty
        $empty = "empty";
    }
    if ($empty == "full") {

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO tbluser(FName,LName,Email,Password,ULevel) VALUES('$fname','$lname','$email','$hash','pending')";

        if ($conn->query($query) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }

        $_SESSION['success'] = "New user Successfully created!";
        header('location: index.php');
    } else {
        echo "<p style='color: red;'>Enter All The Fields Fist.</p>";
    }
}

?>