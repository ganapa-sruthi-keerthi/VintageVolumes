<?php   

    $host = 'localhost';
	$user = 'root';
	$pass = '';
	$db = 'bookstore';
    

    try{
        $conn = mysqli_connect($host,$user,$pass,$db);
        
    }
    catch(mysqli_sql_exception){
        echo "Connection Error";
    }

   

?>