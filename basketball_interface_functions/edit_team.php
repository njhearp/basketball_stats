<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login_user.html");
    exit();
}
$connection = new mysqli("localhost","root","","basketball_stats");
if ($connection->connect_error) die("Connection failed");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id         = intval($_POST['teamID']);
    $games      = intval($_POST['totalGames']);
    $wins       = intval($_POST['totalWins']);

    $sql = "UPDATE teams SET
                totalGames=$games,
                totalWins=$wins
            WHERE teamID=$id";

    if ($connection->query($sql) === TRUE) {
        header("Location: visualize_teams.php");
        exit();
    } else {
        echo "Error updating team: " . $connection->error;
    }
} else {
    $id    = intval($_GET['teamID']);
    $res   = $connection->query("SELECT * FROM teams WHERE teamID=$id");
    if ($res->num_rows !== 1) { echo "Team not found."; exit(); }
    $team  = $res->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>
<head><title>Edit Team</title></head>
<body>
<h2>Edit Team Stats</h2>
<form method="post" action="edit_team.php">
    <input type="hidden" name="teamID" value="<?= htmlspecialchars($team['teamID']) ?>">
    <label>Total Games:</label>
    <input type="number" name="totalGames" value="<?= htmlspecialchars($team['totalGames']) ?>" required><br>
    <label>Total Wins:</label>
    <input type="number" name="totalWins" value="<?= htmlspecialchars($team['totalWins']) ?>" required><br>
    <button type="submit">Save</button>
</form>
</body>
</html>