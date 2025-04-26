<?php
$connection = new mysqli("localhost", "root", "", "basketball_stats");

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Get team list for dropdown
$teams = $connection->query("SELECT teamID, name FROM teams");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $teamID = intval($_POST["teamID"]);
    $name = $connection->real_escape_string($_POST["name"]);
    $surname = $connection->real_escape_string($_POST["surname"]);
    $totalGames = intval($_POST["totalGames"]);
    $totalPoints = intval($_POST["totalPoints"]);
    $totalAssists = intval($_POST["totalAssists"]);
    $attemptedFieldGoals = intval($_POST["attemptedFieldGoals"]);
    $successfulFieldGoals = intval($_POST["successfulFieldGoals"]);
    $steals = intval($_POST["steals"]);
    $blocks = intval($_POST["blocks"]);

    $sql = "INSERT INTO players (teamID, name, surname, totalGames, totalPoints, totalAssists,
                attemptedFieldGoals, successfulFieldGoals, steals, blocks)
            VALUES ($teamID, '$name', '$surname', $totalGames, $totalPoints, $totalAssists,
                    $attemptedFieldGoals, $successfulFieldGoals, $steals, $blocks)";

    if ($connection->query($sql) === TRUE) {
        echo "New player added successfully!";
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
    <title>Add Player</title>
    <link href="../style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <h2>Register a New Player</h2>

    <form action="add_player.php" method="post">
        <label for="name">First Name:</label>
        <input type="text" name="name" id="name" placeholder="Enter first name" required>
        <br>

        <label for="surname">Surname:</label>
        <input type="text" name="surname" id="surname" placeholder="Enter surname" required>
        <br>

        <label for="teamID">Team:</label>
        <select name="teamID" id="teamID" required>
            <option value="">Select team</option>
            <?php while ($row = $teams->fetch_assoc()): ?>
                <option value="<?= $row['teamID'] ?>"><?= htmlspecialchars($row['name']) ?></option>
            <?php endwhile; ?>
        </select>
        <br>

        <label for="totalGames">Total Games:</label>
        <input type="number" name="totalGames" id="totalGames" placeholder="Games played" required>
        <br>

        <label for="totalPoints">Total Points:</label>
        <input type="number" name="totalPoints" id="totalPoints" placeholder="Points scored" required>
        <br>

        <label for="totalAssists">Total Assists:</label>
        <input type="number" name="totalAssists" id="totalAssists" placeholder="Assists made" required>
        <br>

        <label for="attemptedFieldGoals">Attempted Field Goals:</label>
        <input type="number" name="attemptedFieldGoals" id="attemptedFieldGoals" placeholder="Field goals tried" required>
        <br>

        <label for="successfulFieldGoals">Successful Field Goals:</label>
        <input type="number" name="successfulFieldGoals" id="successfulFieldGoals" placeholder="Field goals made" required>
        <br>

        <label for="steals">Steals:</label>
        <input type="number" name="steals" id="steals" placeholder="Steals made" required>
        <br>

        <label for="blocks">Blocks:</label>
        <input type="number" name="blocks" id="blocks" placeholder="Blocks made" required>
        <br>

        <button type="submit">Add Player</button>
    </form>
</body>
</html>
