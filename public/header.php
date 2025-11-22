<?php
require_once __DIR__ . '/../src/auth.php';
?>
<header>
    <h1>Discord Staff Panel</h1>
</header>
<?php if(isAdmin()): ?>
<nav>
    <a href="form.php">Application Form</a>
    <a href="dashboard.php">Dashboard</a>
    <a href="index.php?logout">Logout</a>
</nav>
<?php endif; ?>
<div class="container">
