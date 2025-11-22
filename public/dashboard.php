<?php
require __DIR__ . '/../src/auth.php';
require __DIR__ . '/../src/db.php';

if (!isAdmin()) {
    header('Location: index.php');
    exit;
}

$applications = $collection->find([], ['sort' => ['submitted_at' => -1]]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'header.php'; ?>

<h2>Dashboard</h2>

<table>
    <tr>
        <th>Submitted At</th>
        <?php for ($i=1;$i<=25;$i++): ?>
            <th>Q<?= $i ?></th>
        <?php endfor; ?>
    </tr>
    <?php foreach ($applications as $app): ?>
        <tr>
            <td><?= $app['submitted_at']->toDateTime()->format('Y-m-d H:i:s') ?></td>
            <?php for ($i=1;$i<=25;$i++): ?>
                <td><?= htmlspecialchars($app["q$i"] ?? '') ?></td>
            <?php endfor; ?>
        </tr>
    <?php endforeach; ?>
</table>

<?php include 'footer.php'; ?>
</body>
</html>
