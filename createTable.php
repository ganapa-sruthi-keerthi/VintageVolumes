<?php
//Connects this file(createTable.php) to tje database(bookstore) 
include("DBConn.php");


$table = "tbl_user";

// Check if the table exists
if (!table_exists($table)) {
    // If the table doesn't exist, create it
    createTable($table);
} else {
    // If the table exists, drop it
    dropTable($table);
}


//Functions START ----------------------------

//This will check if the table exists if it does it returns true if not it returns false
function table_exists($table)
{


    //Get the gobal database connection  
    global $conn;

    // Run a query to check if the table exists
    $exists = mysqli_query($conn, "SELECT 1 FROM $table LIMIT 0");

    // Return true if the table exists, false otherwise
    if ($exists) {
        return true;
    } else {
        return false;
    }
}

//This creates  the  dable and then loads the data using the userData.txt file
function createTable($table)
{

    //Get the gobal database connection  
    global $conn;
    $TableQuery = "CREATE TABLE  $table(" .
        "ID int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY," .
        "Img text NOT NULL".
        "FName text NOT NULL," .
        "LName text NOT NULL," .
        "Email text NOT NULL," .
        "Password text NOT NULL," .
        "ULevel text NOT NULL" .
        ");";
    if (mysqli_query($conn, $TableQuery)) {
        echo ("<p>Table named: $table successfully created!</p>");
        loadData($table);
    } else {
        echo ("<p>Error creating the $table table:" . mysqli_error($conn) . "</p>");
    }
}

function dropTable($table)
{

    // Get the global database connection
    global $conn;

    // Query to drop the table
    $DropTableQuery = "DROP TABLE $table";

    // Check if the table was successfully dropped
    if (mysqli_query($conn, $DropTableQuery)) {
        // Display a message indicating the table was dropped and recreated
        echo ("<p>Since table named: $table already exists, it has been dropped and recreated!</p>");

        // Call the createTable() function to recreate the table
        createTable($table);
    } else {
        // Display an error message if there was an issue dropping and creating the table
        echo ("<p>Error dropping and creating the $table table:<br>" . mysqli_error($conn) . "</p>");
    }
}

function loadData($table)
{
    // Get the global database connection
    global $conn;

    // Query to load data from a file into the specified table
    $loadDataQuery = "LOAD DATA INFILE 'C:/xampp/htdocs/Wede6021_Part2_ST10196509_St10214384/userData.txt'" .
        " INTO TABLE $table FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\\r\\n'" .
        "(FName, LName, Email, Password, ULevel)";

    // Check if the data was successfully loaded into the table
    if (mysqli_query($conn, $loadDataQuery)) {
        // Display a success message indicating the data was loaded
        echo ("<p>Data loaded successfully into $table</p>");
    } else {
        // Display an error message if there was an issue loading the data
        echo ("<p>Error loading data into $table: <br>" . mysqli_error($conn) . "</p>");
    }
}


mysqli_close($conn);
    //Fucntions END ------------------------------
