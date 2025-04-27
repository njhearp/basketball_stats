<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login_user.html");
    exit();
}

$connection = new mysqli("localhost","root","","basketball_stats");
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$result = $connection->query("SELECT teamID,name,totalGames,totalWins FROM teams");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>View Teams</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body>
  <div class="nav-back">
    <a href="../user_interface.php">← Back to Dashboard</a>
  </div>
  <h2>All Teams</h2>

  <?php if ($result->num_rows): ?>
    <table>
      <tr>
        <th>Name</th><th>GP</th><th>W</th><th>Win %</th><th>Edit</th><th>Delete</th>
      </tr>
      <?php while ($r = $result->fetch_assoc()):
        $id = (int)$r['teamID'];
        $gp = (int)$r['totalGames'];
        $w  = (int)$r['totalWins'];
        $pct = $gp ? number_format($w/$gp, 3) : '0.000';
      ?>
      <tr>
        <td><?= htmlspecialchars($r['name']) ?></td>
        <td><?= $gp ?></td>
        <td><?= $w ?></td>
        <td><?= $pct ?></td>
        <td><a href="edit_team.php?teamID=<?= $id ?>">Edit</a></td>
        <td><a href="delete_team.php?teamID=<?= $id ?>" onclick="return confirm('Delete this team?')">Delete</a></td>
      </tr>
      <?php endwhile; ?>
    </table>
  <?php else: ?>
    <p>No teams found.</p>
  <?php endif; ?>

</body>
</html>
<?php $connection->close(); ?>
