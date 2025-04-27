<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login_user.html");
    exit();
}
$connection = new mysqli("localhost","root","","basketball_stats");
if ($connection->connect_error) die("Connection failed");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id          = intval($_POST['playerID']);
    $games       = intval($_POST['totalGames']);
    $points      = intval($_POST['totalPoints']);
    $assists     = intval($_POST['totalAssists']);
    $blocks      = intval($_POST['blocks']);
    $steals      = intval($_POST['steals']);

    $sql = "UPDATE players SET
                totalGames=$games,
                totalPoints=$points,
                totalAssists=$assists,
                blocks=$blocks,
                steals=$steals
            WHERE playerID=$id";

    if ($connection->query($sql) === TRUE) {
        header("Location: visualize_players.php");
        exit();
    } else {
        echo "Error updating player: " . $connection->error;
    }
} else {
    $id     = intval($_GET['playerID']);
    $res    = $connection->query("SELECT * FROM players WHERE playerID=$id");
    if ($res->num_rows !== 1) { echo "Player not found."; exit(); }
    $player = $res->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>
<head><title>Edit Player</title></head>
<body>
<h2>Edit Player Stats</h2>
<form method="post" action="edit_player.php">
    <input type="hidden" name="playerID" value="<?= htmlspecialchars($player['playerID']) ?>">
    <label>Games Played:</label>
    <input type="number" name="totalGames" value="<?= htmlspecialchars($player['totalGames']) ?>" required><br>
    <label>Total Points:</label>
    <input type="number" name="totalPoints" value="<?= htmlspecialchars($player['totalPoints']) ?>" required><br>
    <label>Total Assists:</label>
    <input type="number" name="totalAssists" value="<?= htmlspecialchars($player['totalAssists']) ?>" required><br>
    <label>Blocks:</label>
    <input type="number" name="blocks" value="<?= htmlspecialchars($player['blocks']) ?>" required><br>
    <label>Steals:</label>
    <input type="number" name="steals" value="<?= htmlspecialchars($player['steals']) ?>" required><br>
    <button type="submit">Save</button>
</form>
</body>
</html>