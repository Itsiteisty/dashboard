<?php
session_start();

function login($password) {
    $adminPassword = getenv('ADMIN_PASSWORD');
    if ($password === $adminPassword) {
        $_SESSION['admin'] = true;
        return true;
    }
    return false;
}

function logout() {
    session_destroy();
}

function isAdmin() {
    return isset($_SESSION['admin']) && $_SESSION['admin'] === true;
}
