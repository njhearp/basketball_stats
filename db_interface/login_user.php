<?php
session_start();

// Connect to the database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "basketball_stats";

$connection = new mysqli($host, $user, $pass, $db);
if ($connection->connect_error) {
    die("Connection failed");
}

// Read & sanitize inputs
$id       = $connection->real_escape_string($_POST["username"]);
$password = md5($_POST["password"]); // switch to password_hash/verify in production

// Check credentials
$sql           = "SELECT * FROM users WHERE username = '$id' AND password = '$password'";
$query_results = $connection->query($sql);

if ($query_results && $query_results->num_rows > 0) {
    // successful login → set session + redirect
    $_SESSION['username'] = $id;
    header("Location: ../user_interface.php");
    exit();
} else {
    echo "Invalid username or password";
}

$connection->close();
?>
