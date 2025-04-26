<?php
// Connect to the database
$connection = new mysqli("localhost", "root", "", "basketball_stats");

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Query all teams
$sql = "SELECT * FROM teams";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>All Teams</h2>";
    echo "<table border='1'>
            <tr>
                <th>Name</th>
                <th>Total Games</th>
                <th>Wins</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row["name"]) . "</td>
                <td>" . htmlspecialchars($row["totalGames"]) . "</td>
                <td>" . htmlspecialchars($row["totalWins"]) . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No teams found.";
}

$connection->close();
?>
