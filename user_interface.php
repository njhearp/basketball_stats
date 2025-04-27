<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login_user.html");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>User Interface</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="nav-back">
    <a href="user_interface.php"> Home</a>
  </div>
  <h1>NBA Statistics Home Page</h1>

  <a href="basketball_interface_functions/add_team.php">Add a new team</a><br>
  <a href="basketball_interface_functions/add_player.php">Add a new player</a><br>
  <a href="basketball_interface_functions/visualize_teams.php">View teams</a><br>
  <a href="basketball_interface_functions/visualize_players.php">View players</a><br>
  <a href="basketball_interface_functions/logout.php">Logout</a>
</body>
</html>
