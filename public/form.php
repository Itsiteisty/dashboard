<?php
require_once __DIR__ . '/../src/db.php';   // Ajuste o caminho conforme sua estrutura
require_once __DIR__ . '/../src/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'discord_id' => $_POST['discord_id'],
        'username' => $_POST['username'],
        'answers' => $_POST,
        'status' => 'pending',
        'created_at' => new MongoDB\BSON\UTCDateTime()
    ];
    unset($data['submit']);
    $db->staff_forms->insertOne($data);
    $msg = "Application submitted successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Staff Application</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<h2>Staff Application Form</h2>
<?php if(isset($msg)) echo "<p class='success'>$msg</p>"; ?>
<form method="POST">
    <input type="text" name="discord_id" placeholder="Discord ID" required>
    <input type="text" name="username" placeholder="Username" required>
    <?php for($i=1;$i<=25;$i++): ?>
        <label>Question <?= $i ?>:</label>
        <textarea name="q<?= $i ?>" required></textarea>
    <?php endfor; ?>
    <button type="submit" name="submit">Submit</button>
</form>
</body>
</html>
