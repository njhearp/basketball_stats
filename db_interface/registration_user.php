<?php
// start buffering to prevent any accidental output
ob_start();

// 1) Connect
$connection = new mysqli("localhost", "root", "", "basketball_stats");
if ($connection->connect_error) {
    die("Connection failed");
}

// 2) Read & sanitize inputs
$username = $connection->real_escape_string($_POST["username"]);
$name     = $connection->real_escape_string($_POST["name"]);
$surname  = $connection->real_escape_string($_POST["surname"]);
// switch to password_hash() in production!
$password = md5($_POST["password"]);

// 3) Run INSERT (use the actual column name: username)
$sql = "
  INSERT INTO users (username, password, name, surname)
  VALUES ('$username', '$password', '$name', '$surname')
";

if ($connection->query($sql) === TRUE) {
    // 4) Redirect *before* any output
    header("Location: ../user_interface.php");
    exit();
} else {
    // handle error (no redirect)
    echo "Error saving user: " . htmlspecialchars($connection->error);
}

$connection->close();
?>
