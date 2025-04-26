<?php
// Connect to the database
$connection = new mysqli("localhost", "root", "", "basketball_stats");

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Query players + team names
$sql = "SELECT players.name AS playerName, players.surname AS playerSurname, teams.name AS teamName, players.totalGames, players.totalPoints, players.totalAssists
        FROM players
        LEFT JOIN teams ON players.teamID = teams.teamID";

$result = $connection->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>All Players</h2>";
    echo "<table border='1'>
            <tr>
                <th>Player Name</th>
                <th>Team Name</th>
                <th>Total Games</th>
                <th>Total Points</th>
                <th>Total Assists</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        $fullName = htmlspecialchars($row["playerName"]) . " " . htmlspecialchars($row["playerSurname"]);

        echo "<tr>
                <td>" . $fullName . "</td>
                <td>" . htmlspecialchars($row["teamName"]) . "</td>
                <td>" . htmlspecialchars($row["totalGames"]) . "</td>
                <td>" . htmlspecialchars($row["totalPoints"]) . "</td>
                <td>" . htmlspecialchars($row["totalAssists"]) . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No players found.";
}

$connection->close();
?>
