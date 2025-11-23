<?php
// Automatically redirect to the login page after 5 seconds
header("Refresh: 5; url=/public/terms/terms.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Starting...</title>
    <link rel="stylesheet" href="/public/assets/css/style.css">
</head>
<body>
    <div class="box">
        <h2>Loading System...</h2>
        <p>You will be redirected to the login page shortly.</p>
        <div class="loader"></div>
        <div class="glow-text">⚡ Get Ready! ⚡</div>
    </div>
</body>
</html>
