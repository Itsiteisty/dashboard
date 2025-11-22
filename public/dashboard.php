<?php
require_once __DIR__ . '/../src/auth.php';
require_once __DIR__ . '/../src/db.php';

if (!isLoggedIn()) { // verifica se admin está logado
    header('Location: index.php');
    exit;
}

$forms = $collection->find([], ['sort' => ['_id' => -1]]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<h2>Discord Staff Admin Panel</h2>
<p><a href="index.php?logout=1">Logout</a></p>
<?php foreach ($forms as $form): ?>
<div class="form-entry">
    <?php for ($i = 1; $i <= 25; $i++): ?>
        <p><strong>Q<?= $i ?>:</strong> <?= htmlspecialchars($form["question_$i"]) ?></p>
    <?php endfor; ?>
    <hr>
</div>
<?php endforeach; ?>
</body>
</html>
