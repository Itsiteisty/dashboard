<?php
session_start();

function login($password) {
    $adminPass = getenv('ADMIN_PASSWORD'); // Defina no Render
    if ($password === $adminPass) {
        $_SESSION['admin'] = true;
        return true;
    }
    return false;
}

function logout() {
    session_destroy();
}

function isLoggedIn() {
    return isset($_SESSION['admin']) && $_SESSION['admin'] === true;
}
