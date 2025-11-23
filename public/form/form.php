<?php
require_once __DIR__ . '/../../src/controllers/FormController.php';
$controller = new FormController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'name' => $_POST['name'] ?? '',
        'discord' => $_POST['discord'] ?? '',
        'age' => $_POST['age'] ?? '',
        'answers' => []
    ];

    for ($i = 1; $i <= 25; $i++) {
        $data['answers'][] = $_POST["question$i"] ?? '';
    }

    $result = $controller->submit($data);

    if ($result['success']) {
        header("Location: /public/r/redirectty.php");
        exit;
    } else {
        echo "<p>{$result['message']}</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Discord Staff Application</title>
    <link rel="stylesheet" href="/public/assets/css/stylef.css">
</head>
<body>
    <form method="POST" action="">
        <label>Full Name:</label>
        <input type="text" name="name" required>

        <label>Discord Tag:</label>
        <input type="text" name="discord" required>

        <label>Age:</label>
        <input type="number" name="age" required>

        <?php
        $questions = [
            "Have you ever managed a Discord server before?",
            "What experience do you have with server moderation?",
            "How would you handle conflicts between members?",
            "Are you available daily for moderation?",
            "Do you know the basic Discord rules?",
            "How would you deal with spam and bots?",
            "Do you have experience with moderation bots?",
            "How would you handle harassment reports?",
            "Have you been staff on another server? What role?",
            "What is your approach to dealing with toxic members?",
            "Have you ever had to make difficult staff decisions?",
            "How do you handle members who repeatedly break rules?",
            "Do you know basic moderation commands?",
            "How would you motivate the community members?",
            "Do you have experience creating events on Discord?",
            "Have you dealt with problematic or banned users before?",
            "How do you handle criticism and feedback?",
            "Are you willing to learn new tools?",
            "How would you ensure rules are applied fairly?",
            "What is your experience with Discord Nitro and perks?",
            "Are you comfortable managing underage users?",
            "How would you report issues to the main team?",
            "Have you ever trained new staff members?",
            "How would you maintain order in busy chats?",
            "Why do you want to become staff on this server?"
        ];

        for ($i = 1; $i <= 25; $i++) {
            echo "<label>{$questions[$i-1]}</label>";
            echo "<textarea name='question$i' required></textarea>";
        }
        ?>

        <button type="submit">Submit Application</button>
    </form>
</body>
</html>
