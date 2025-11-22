<?php
require __DIR__ . '/../src/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'] ?? '';
    if (login($password)) {
        header('Location: dashboard.php');
        exit;
    } else {
        $error = "Incorrect password!";
    }
}

if(isset($_GET['logout'])) {
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
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<h2>Admin Login</h2>
<?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
<form method="POST">
    <input type="password" name="password" placeholder="Admin Password" required>
    <button type="submit">Login</button>
</form>
<p><a href="form.php">I'm not admin</a></p>
</body>
</html>
