<?php
session_start();

define('ADMIN_PASSWORD', getenv('ADMIN_PASSWORD') ?: 'admin123');

function login($password) {
    if($password === ADMIN_PASSWORD) {
        $_SESSION['admin'] = true;
        return true;
    }
    return false;
}

function logout() {
    unset($_SESSION['admin']);
}

function isLoggedIn() {
    return !empty($_SESSION['admin']);
}
