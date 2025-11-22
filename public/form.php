<?php
require '../src/auth.php';
if (!isAdmin()) {
    header('Location: index.php');
    exit;
}
require '../src/db.php';

// 25 Discord Staff Questions
$questions = [
    "Discord Tag (Username#1234)",
    "Why do you want to become staff?",
    "Previous moderation experience",
    "Hours available per week",
    "Knowledge of moderation tools",
    "Have you ever been banned from a server?",
    "How do you handle conflicts?",
    "Do you understand Discord rules?",
    "How would you deal with spam or raids?",
    "How do you handle reports from users?",
    "Have you been staff before?",
    "Have you worked with bots before?",
    "How do you organize tasks?",
    "How do you communicate with a team?",
    "Are you open to feedback and criticism?",
    "Are you active in the server?",
    "Are you aware of staff responsibilities?",
    "Have you reported technical problems before?",
    "How do you deal with trolls?",
    "How do you stay calm under pressure?",
    "How do you manage multiple tasks at once?",
    "Do you understand the code of conduct?",
    "Are you available for emergencies?",
    "How do you react to negative feedback?",
    "Additional comments or notes"
];

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
    <title>Discord Staff Application Form</title>
</head>
<body>
    <h1>Discord Staff Application Form</h1>
    <?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <?php foreach ($questions as $i => $q): ?>
            <label for="q<?= $i+1 ?>"><?= $q ?>:</label><br>
            <input type="text" id="q<?= $i+1 ?>" name="q<?= $i+1 ?>" required><br><br>
        <?php endforeach; ?>
        <button type="submit">Submit</button>
    </form>
    <a href="dashboard.php">View Dashboard</a>
</body>
</html>
