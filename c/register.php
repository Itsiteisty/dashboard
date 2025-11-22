<?php
require_once "../src/auth.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uuid = registerUser($_POST['username'], $_POST['password']);
    header("Location: ../public/dashboard.php/$uuid");
    exit;
}
?>

<link rel="stylesheet" href="../public/style.css">
<div class="container">
    <h1>Register</h1>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
    </form>
    <a href="login.php">Already have an account? Login</a>
</div>
