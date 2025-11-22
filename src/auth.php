<?php
session_start();

function isAdmin() {
    return isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] === true;
}

function login($password) {
    $adminPassword = getenv('ADMIN_PASSWORD'); // Defina no Render
    if ($password === $adminPassword) {
        $_SESSION['admin_logged'] = true;
        return true;
    }
    return false;
}

function logout() {
    session_destroy();
}
?>
