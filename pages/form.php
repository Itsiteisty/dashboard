<?php
require_once "../src/db.php";
require_once "../src/auth.php";
checkLogin();
?>

<link rel="stylesheet" href="../public/style.css">
<div class="dashboard">
    <h1>Forms Page</h1>
    <form method="post">
        <input type="text" name="field1" placeholder="Field 1">
        <input type="text" name="field2" placeholder="Field 2">
        <button type="submit">Submit Form</button>
    </form>
    <a href="../public/dashboard.php">Back to Dashboard</a>
</div>
