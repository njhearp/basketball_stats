<?php 
    // 1. Read the data from the login form (username and password) and store the information in variables
    // 2. Exploit the variables to query the database and find whether the user exists in the user table
    //  2.1 Connect to our database (after db creation)

    // Connect to the database
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "student_management";

    $connection_object = new mysqli($host, $user, $pass, $db);

    if ($connection_object->connect_error) {
        die("Connection failed");
    }

    echo "Connected successfully";

    // Read the data from the login form
    // To read a value of a form field in the HTML page, if the method of the form is POST, we can use the global variable $_POST in th PHP file.
    $id = $_POST["username"];
    $password = MD5($_POST["password"]);

    // Query preparation exploiting the variables of username and password
    $sql = "SELECT * FROM users WHERE username = '$id' AND password = '$password'";

    echo $sql;
    // Query execution
    $query_results = $connection_object->query($sql);

    // Check if the user exists in the database
    echo $query_results->num_rows;
    if ($query_results->num_rows > 0) {
        echo "Welcome, user! I've found you in the db";
        
    }
    else {
        echo "I don't know you!";
    }
    // Redirect the user to the dashboard page
    header("Location: ../dashboard.php");
?>