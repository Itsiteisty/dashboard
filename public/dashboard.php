<?php
require __DIR__ . '/src/auth.php';
if (!isAdmin()) {
    header('Location: index.php');
    exit;
}
require '../src/db.php';

$submissions = $collection->find([], ['sort' => ['submitted_at' => -1]]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Discord Staff Dashboard</title>
</head>
<body>
    <h1>Discord Staff Applications Dashboard</h1>
    <a href="form.php">Back to Form</a> | <a href="index.php?logout=1">Logout</a>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <?php for ($i=1; $i<=25; $i++) echo "<th>Q$i</th>"; ?>
            <th>Submitted At</th>
        </tr>
        <?php foreach ($submissions as $s): ?>
        <tr>
            <td><?= $s->_id ?></td>
            <?php for ($i=1; $i<=25; $i++): ?>
                <td><?= htmlspecialchars($s["q$i"] ?? '') ?></td>
            <?php endfor; ?>
            <td><?= $s['submitted_at']->toDateTime()->format('Y-m-d H:i:s') ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
