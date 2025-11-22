<?php
require __DIR__ . '/../src/auth.php';
require __DIR__ . '/../src/db.php';

if (!isLoggedIn()) {
    header('Location: index.php');
    exit;
}

// Busca todos os formulários no MongoDB
$forms = $collection->find([], ['sort' => ['submitted_at' => -1]]);
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

<h2>Discord Staff Dashboard</h2>

<!-- Painel de indicadores -->
<div class="cards">
    <div class="card">
        <h3>Total Applicants</h3>
        <p><?= $collection->countDocuments(); ?></p>
    </div>
    <div class="card approved">
        <h3>Approved</h3>
        <p><?= $collection->countDocuments(['status' => 'approved']); ?></p>
    </div>
    <div class="card rejected">
        <h3>Rejected</h3>
        <p><?= $collection->countDocuments(['status' => 'rejected']); ?></p>
    </div>
    <div class="card pending">
        <h3>Pending</h3>
        <p><?= $collection->countDocuments(['status' => 'pending']); ?></p>
    </div>
</div>

<!-- Lista de formulários -->
<div class="form-list">
    <?php foreach ($forms as $form): ?>
    <div class="form-entry <?= $form['status']; ?>">
        <p><strong>Discord ID:</strong> <?= $form['discord_id']; ?></p>
        <p><strong>Username:</strong> <?= $form['username']; ?></p>
        <?php for ($i=1; $i<=25; $i++): ?>
            <p><strong>Question <?= $i ?>:</strong> <?= $form['q'.$i] ?? ''; ?></p>
        <?php endfor; ?>
        <p><strong>Status:</strong> <span class="status <?= $form['status']; ?>"><?= ucfirst($form['status']); ?></span></p>
        <div class="buttons">
            <a href="update.php?id=<?= $form['_id'] ?>&action=approve" class="btn approve">Approve</a>
            <a href="update.php?id=<?= $form['_id'] ?>&action=reject" class="btn reject">Reject</a>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
