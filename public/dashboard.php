<?php
require_once "../src/auth.php";

checkLogin(); // já pega UUID da sessão, cookie ou URL

?>

<link rel="stylesheet" href="style.css">
<div class="dashboard">
    <h1>Welcome <?= $_SESSION['username'] ?></h1>
    <p>UUID: <?= $_SESSION['uuid'] ?></p>

    <?php if ($_SESSION['is_admin']): ?>
        <p><a href="../page/forms.php">Go to Admin Forms</a></p>
    <?php else: ?>
        <p>User Dashboard</p>
    <?php endif; ?>

    <a href="../c/logout.php">Logout</a>
</div>
