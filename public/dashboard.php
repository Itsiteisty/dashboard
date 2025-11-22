<?php
require __DIR__ . '/../src/auth.php';
require __DIR__ . '/../src/db.php';

if (!checkAuth()) {
    header('Location: index.php');
    exit;
}

$forms = $collection->find();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include __DIR__ . '/header.php'; ?>

<h2>Dashboard</h2>
<a href="index.php?logout=1">Logout</a>
<table>
    <tr>
        <?php for ($i=1; $i<=25; $i++): ?>
            <th>Q<?= $i ?></th>
        <?php endfor; ?>
    </tr>
    <?php foreach ($forms as $form): ?>
    <tr>
        <?php for ($i=1; $i<=25; $i++): ?>
            <td><?= htmlspecialchars($form["q$i"]) ?></td>
        <?php endfor; ?>
    </tr>
    <?php endforeach; ?>
</table>

<?php include __DIR__ . '/footer.php'; ?>
</body>
</html>
