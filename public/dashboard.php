<?php
require __DIR__ . '/../src/auth.php';
requireAdmin(); // Somente admins
require __DIR__ . '/../src/db.php'; // Conexão MongoDB

use MongoDB\BSON\ObjectId;

// Pega todos os candidatos ordenados do mais recente
$applicantsCursor = $collection->find([], ['sort' => ['_id' => -1]]);
$applicants = iterator_to_array($applicantsCursor); // Corrige erro de cursor

// Inicializa contadores
$total = $approved = $rejected = $pending = 0;

foreach ($applicants as $a) {
    $status = $a['status'] ?? 'pending';
    $total++;
    if ($status === 'approved') $approved++;
    elseif ($status === 'rejected') $rejected++;
    else $pending++;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Discord Staff Admin Panel</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'header.php'; ?>

<h1>Discord Staff Admin Panel</h1>

<div class="stats">
    <div>Total Applicants: <?php echo $total; ?></div>
    <div>Approved: <?php echo $approved; ?></div>
    <div>Rejected: <?php echo $rejected; ?></div>
    <div>Pending: <?php echo $pending; ?></div>
</div>

<?php if (isset($_GET['msg'])): ?>
    <p class="msg"><?php echo htmlspecialchars($_GET['msg']); ?></p>
<?php endif; ?>

<div class="applicants">
    <?php foreach ($applicants as $a): ?>
        <div class="applicant-card">
            <p><strong>Discord ID:</strong> <?php echo $a['discord_id'] ?? 'N/A'; ?></p>
            <p><strong>Username:</strong> <?php echo $a['username'] ?? 'N/A'; ?></p>

            <?php for ($i = 1; $i <= 25; $i++): ?>
                <p><strong>Question <?php echo $i; ?>:</strong> <?php echo $a['q'.$i] ?? ''; ?></p>
            <?php endfor; ?>

            <p><strong>Status:</strong> <?php echo ucfirst($a['status'] ?? 'pending'); ?></p>

            <div class="actions">
                <a href="update.php?id=<?php echo $a['_id']; ?>&action=approve" class="btn btn-approve">Approve</a>
                <a href="update.php?id=<?php echo $a['_id']; ?>&action=reject" class="btn btn-reject">Reject</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
