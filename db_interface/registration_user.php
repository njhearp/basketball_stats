<?php 

    // Connect to the database
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "basketball_stats";

    $connection_object = new mysqli($host, $user, $pass, $db);

    if ($connection_object->connect_error) {
        die("Connection failed");
    }

    echo "Connected successfully";

    // Read all the form fields and save the corresponding values to php variables
    $username = $_POST["username"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $password = MD5($_POST["password"]);

    // Write the mysql query to write on the databare and insert a new record in the users table
    $register_user_query = "INSERT INTO users (id, password, name, surname) VALUES ('$username', '$password', '$name', '$surname')";
    // echo $register_user_query;

    // Execute the query
    $results = $connection_object->query($register_user_query);

    if ($results === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $register_user_query . "<br>" . $connection_object->error;
    }

    // Jump to the dashboard.html page
    header("Location: ../dashboard.php");