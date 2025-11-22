<?php
require __DIR__ . '/../src/auth.php';
requireAdmin(); // Somente admins podem acessar
require __DIR__ . '/../src/db.php'; // Conexão com MongoDB

use MongoDB\BSON\ObjectId;

// Busca todos os candidatos
$applicants = $collection->find([], ['sort' => ['_id' => -1]]);

// Contadores
$total = $approved = $rejected = $pending = 0;
foreach ($applicants as $a) {
    $total++;
    $status = $a['status'] ?? 'pending';
    if ($status === 'approved') $approved++;
    elseif ($status === 'rejected') $rejected++;
    else $pending++;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Discord Staff Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'header.php'; ?>

<h1>Discord Staff Admin Panel</h1>
<h2>Dashboard</h2>

<div class="stats">
    <div>Total Applicants: <?php echo $total; ?></div>
    <div>Approved: <?php echo $approved; ?></div>
    <div>Rejected: <?php echo $rejected; ?></div>
    <div>Pending: <?php echo $pending; ?></div>
</div>

<hr>

<?php foreach ($applicants as $app): ?>
    <?php
    $discord_id = $app['discord_id'] ?? 'N/A';
    $username   = $app['username'] ?? 'N/A';
    $status     = ucfirst($app['status'] ?? 'pending');
    $questions  = $app['questions'] ?? array_fill(0, 25, 'No answer');
    $id         = (string) $app['_id'];
    ?>
    <div class="applicant-card">
        <strong>Discord ID:</strong> <?php echo htmlspecialchars($discord_id); ?><br>
        <strong>Username:</strong> <?php echo htmlspecialchars($username); ?><br>
        <?php for ($i = 0; $i < 25; $i++): ?>
            <strong>Question <?php echo $i + 1; ?>:</strong> <?php echo htmlspecialchars($questions[$i]); ?><br>
        <?php endfor; ?>
        <strong>Status:</strong> <?php echo htmlspecialchars($status); ?><br>

        <?php if ($status === 'pending'): ?>
            <a href="update.php?id=<?php echo $id; ?>&action=approve" class="btn-approve">Approve</a>
            <a href="update.php?id=<?php echo $id; ?>&action=reject" class="btn-reject">Reject</a>
        <?php else: ?>
            <span class="status-label"><?php echo $status; ?></span>
        <?php endif; ?>
    </div>
    <hr>
<?php endforeach; ?>

<?php include 'footer.php'; ?>
</body>
</html>
