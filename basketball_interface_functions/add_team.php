<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$connection = new mysqli("localhost", "root", "", "basketball_stats");

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $connection->real_escape_string($_POST["name"]);
    $totalGames = intval($_POST["totalGames"]);
    $wins = intval($_POST["wins"]);

    $sql = "INSERT INTO teams (name, totalGames, totalWins)
            VALUES ('$name', $totalGames, $wins)";

    if ($connection->query($sql) === TRUE) {
        echo "New team added successfully!";
        header("Location: ../user_interface.php");
        exit();
    } else {
        echo "Error: " . $connection->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Team</title>
    <link href="../style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <h2>Register a New Team</h2>

    <form action="add_team.php" method="post">
        <label for="name">Team Name:</label>
        <input type="text" name="name" id="name" placeholder="Enter team name" required>
        <br>

        <label for="totalGames">Total Games:</label>
        <input type="number" name="totalGames" id="totalGames" placeholder="Games played" required>
        <br>

        <label for="wins">Wins:</label>
        <input type="number" name="wins" id="wins" placeholder="Games won" required>
        <br>

        <button type="submit">Add Team</button>
    </form>
</body>
</html>
