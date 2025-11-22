<?php
require '../src/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'] ?? '';
    if (login($password)) {
        header('Location: form.php');
        exit;
    } else {
        $error = "Incorrect password!";
    }
}

if (isset($_GET['logout'])) {
    logout();
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
</head>
<body>
    <h1>Admin Login</h1>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <input type="password" name="password" placeholder="Admin Password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>
