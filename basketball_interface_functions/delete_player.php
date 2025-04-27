<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login_user.html");
    exit();
}
$id = intval($_GET['playerID']);
$connection = new mysqli("localhost","root","","basketball_stats");
if ($connection->connect_error) die("Connection failed");
$connection->query("DELETE FROM players WHERE playerID=$id");
header("Location: visualize_players.php");
exit();
?>