<?php
session_start();

function login($password) {
    $adminPassword = getenv('ADMIN_PASSWORD') ?: 'admin123';
    if ($password === $adminPassword) {
        $_SESSION['admin_logged_in'] = true;
        return true;
    }
    return false;
}

function logout() {
    session_destroy();
}

function checkAuth() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}
?>
