<?php
require_once "../src/auth.php";
require_once "../src/db.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (loginUser($_POST['username'], $_POST['password'])) {
        header("Location: ../public/dashboard.php");
        exit;
    } else {
        $error = "Invalid credentials";
    }
}
?>

<link rel="stylesheet" href="../public/style.css">
<div class="container">
    <h1>Login</h1>
    <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <a href="register.php">Register</a>
</div>
