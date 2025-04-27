<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login_user.html");
    exit();
}

$connection = new mysqli("localhost", "root", "", "basketball_stats");
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$sql = "
SELECT
    p.playerID,
    p.name    AS playerName,
    p.surname AS playerSurname,
    t.name    AS teamName,
    p.totalGames,
    p.totalPoints,
    p.totalAssists,
    p.blocks,
    p.steals
FROM players p
LEFT JOIN teams t ON p.teamID = t.teamID
";
$result = $connection->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>View Players</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body>
  <div class="nav-back">
    <a href="../user_interface.php">← Back to Dashboard</a>
  </div>
  <h2>All Players</h2>

  <?php if ($result && $result->num_rows > 0): ?>
    <table>
      <tr>
        <th>Name</th><th>Team</th><th>GP</th>
        <th>PPG</th><th>APG</th><th>BPG</th><th>SPG</th>
        <th>Edit</th><th>Delete</th>
      </tr>
      <?php while ($r = $result->fetch_assoc()): 
        $id   = (int)$r['playerID'];
        $games = (int)$r['totalGames'];
        $ppg = $games ? round($r['totalPoints'] / $games, 2) : 0;
        $apg = $games ? round($r['totalAssists']/ $games, 2) : 0;
        $bpg = $games ? round($r['blocks']       / $games, 2) : 0;
        $spg = $games ? round($r['steals']       / $games, 2) : 0;
      ?>
      <tr>
        <td><?= htmlspecialchars($r['playerName'] . ' ' . $r['playerSurname']) ?></td>
        <td><?= htmlspecialchars($r['teamName']) ?></td>
        <td><?= $games ?></td>
        <td><?= $ppg ?></td>
        <td><?= $apg ?></td>
        <td><?= $bpg ?></td>
        <td><?= $spg ?></td>
        <td><a href="edit_player.php?playerID=<?= $id ?>">Edit</a></td>
        <td><a href="delete_player.php?playerID=<?= $id ?>" onclick="return confirm('Delete this player?')">Delete</a></td>
      </tr>
      <?php endwhile; ?>
    </table>
  <?php else: ?>
    <p>No players found.</p>
  <?php endif; ?>

</body>
</html>
<?php $connection->close(); ?>
