<?php
require_once __DIR__ . '/../src/db.php'; // MongoDB connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [];
    for ($i = 1; $i <= 25; $i++) {
        $data["question_$i"] = $_POST["question_$i"] ?? '';
    }
    $collection->insertOne($data);
    $success = "Form submitted successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Staff Application Form</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<h2>Staff Application Form</h2>
<?php if(isset($success)) echo "<p class='success'>$success</p>"; ?>

<form method="POST">
<?php for ($i = 1; $i <= 25; $i++): ?>
    <label>Question <?= $i ?>:</label>
    <input type="text" name="question_<?= $i ?>" required><br>
<?php endfor; ?>
<button type="submit">Submit</button>
</form>

<!-- Botão para admin voltar -->
<p>Admin? <a href="index.php">Go to Admin Login</a></p>
</body>
</html>
