<?php
require __DIR__ . '/../src/auth.php';
require __DIR__ . '/../src/db.php';

if (!checkAuth()) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [];
    for ($i=1; $i<=25; $i++) {
        $data["q$i"] = $_POST["q$i"] ?? '';
    }
    $collection->insertOne($data);
    $success = "Form submitted successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Form</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include __DIR__ . '/header.php'; ?>

<h2>Staff Application Form</h2>
<?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
<form method="POST">
<?php for ($i=1; $i<=25; $i++): ?>
    <label>Question <?= $i ?>:</label>
    <input type="text" name="q<?= $i ?>" required><br>
<?php endfor; ?>
    <button type="submit">Submit</button>
</form>

<?php include __DIR__ . '/footer.php'; ?>
</body>
</html>
