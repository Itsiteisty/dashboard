<?php
require __DIR__ . '/../src/auth.php';
require __DIR__ . '/../src/db.php';

if (!isAdmin()) {
    header('Location: index.php');
    exit;
}

$questions = [
    "Discord Tag (Username#1234)",
    "Why do you want to become staff?",
    "How many hours per week can you dedicate?",
    "Have you been a staff member before?",
    "What previous experience do you have?",
    "How would you handle a disruptive member?",
    "How do you react under stress?",
    "Do you understand Discord rules?",
    "How familiar are you with moderation bots?",
    "Can you enforce rules fairly?",
    "Have you read our server guidelines?",
    "Do you know how to use logs effectively?",
    "What timezone are you in?",
    "Can you attend voice chats if needed?",
    "How would you deal with conflict between staff?",
    "Are you comfortable giving warnings?",
    "Do you know how to mute/ban members?",
    "Have you ever handled a difficult situation?",
    "Why should we select you?",
    "What makes you trustworthy?",
    "Do you have any suggestions to improve the server?",
    "Can you handle confidential information?",
    "How do you motivate members?",
    "Are you willing to learn new tools?",
    "Any additional comments?"
];

$success = $error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [];
    foreach ($questions as $i => $q) {
        $key = "q" . ($i + 1);
        $data[$key] = $_POST[$key] ?? '';
    }
    $data['submitted_at'] = new MongoDB\BSON\UTCDateTime();

    try {
        $collection->insertOne($data);
        $success = "Application submitted successfully!";
    } catch (Exception $e) {
        $error = "Error submitting application: " . $e->getMessage();
    }
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
<?php include 'header.php'; ?>

<h2>Staff Application</h2>
<?php if ($success) echo "<p class='success'>$success</p>"; ?>
<?php if ($error) echo "<p class='error'>$error</p>"; ?>

<form method="POST">
    <?php foreach ($questions as $i => $q): ?>
        <label><?= htmlspecialchars($q) ?></label>
        <input type="text" name="q<?= $i+1 ?>" required>
    <?php endforeach; ?>
    <button type="submit">Submit</button>
</form>

<?php include 'footer.php'; ?>
</body>
</html>
