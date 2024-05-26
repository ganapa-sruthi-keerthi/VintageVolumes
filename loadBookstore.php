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
<?php

// Include the database connection file
include 'DBConn.php';



if (isset($_POST['load_books'])) {
  loadbookstore(); // loadbooks function/method
  header('location: about.php');
  
}


function loadbookstore()
{ // Loading table

  // Get the database name
  global $conn;

  // Check if the table exists
  $sql = "SHOW TABLES LIKE 'tblbooks';";
  $result = $conn->query($sql);

  // If the table does not exist, create it
  if ($result->num_rows == 0) {
    $sql = "CREATE TABLE tblbooks (
      id INT NOT NULL AUTO_INCREMENT ,
      img text(255),
      title text(255),
      author text(255),
      price int(255),
      isbn text(255),
      quantity int(255),
      PRIMARY KEY (id)
    );";
    $conn->query($sql);
  }


  // Insert some data into the books table
  $sql = "INSERT INTO tblbooks (img,title, author, price, isbn, quantity)
VALUES ('img1.jpg','Database Principles','Don Gosselin',1500,'9780538745840',5);";
  $conn->query($sql);

  $sql = "INSERT INTO tblbooks (img, title, author, price, isbn, quantity)
VALUES ('img3.jpg', 'System analysis and design','Jhon w.Satzinger',1650,'9781111534158',5);";
  $conn->query($sql);

  $sql = "INSERT INTO tblbooks (img, title, author, price, isbn, quantity)
VALUES ('img2.jpg', 'Php programming with mysql','Andre Troelsen',800,'9780538745840',5);";
  $conn->query($sql);

  $sql = "INSERT INTO tblbooks (img, title, author, price, isbn, quantity)
VALUES ('img4.jpg', 'Pro C# 9 with .Net 5','Andrew Troelsen, Philip Japikse',2000,'9781484269381',5);";
  $conn->query($sql);

  $sql = "INSERT INTO tblbooks (img, title, author, price, isbn, quantity)
VALUES ('img5.jpg', 'SQL Server Programming 2012','Paul Atkinson, Robert Viera',1250,'9780735658226',5);";
  $conn->query($sql);

  $sql = "INSERT INTO tblbooks (img, title, author, price, isbn, quantity)
VALUES ('intro_algo.jpg', 'Introduction to Algorithms','
Thomas H. Cormen',1200,'978-0262533058',5);";
  $conn->query($sql);

//   $sql = "INSERT INTO tblbooks (img, title, author, price, isbn, quantity)
// VALUES ('img6.jpg', 'Understanding Operating Systems','Ann Mclver Mchoes',950,'9781439079201',5);";
//   $conn->query($sql);




  // Close the database connection
  $conn = null;
}
