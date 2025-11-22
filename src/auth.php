<?php
require_once "db.php"; // inclui conexão
use Ramsey\Uuid\Uuid;

session_start();

/**
 * Registra um usuário e retorna UUID
 */
function registerUser($username, $password, $isAdmin = false) {
    global $collection;
    $uuid = Uuid::uuid4()->toString();
    $collection->insertOne([
        'uuid' => $uuid,
        'username' => $username,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'is_admin' => $isAdmin
    ]);

    // Salva UUID em sessão e cookie
    $_SESSION['uuid'] = $uuid;
    $_SESSION['username'] = $username;
    $_SESSION['is_admin'] = $isAdmin;
    setcookie("user_uuid", $uuid, time()+3600*24, "/");

    return $uuid;
}

/**
 * Login de usuário
 */
function loginUser($username, $password) {
    global $collection;
    $user = $collection->findOne(['username' => $username]);
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['uuid'] = $user['uuid'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['is_admin'] = $user['is_admin'];
        setcookie("user_uuid", $user['uuid'], time()+3600*24, "/");
        return true;
    }
    return false;
}

/**
 * Verifica se o usuário está logado
 * Aceita UUID via sessão, cookie ou URL PATH_INFO
 */
function checkLogin() {
    global $collection;

    // Se já está na sessão, ok
    if (isset($_SESSION['uuid'])) return;

    $uuid = null;

    // Tenta pegar UUID via cookie
    if (isset($_COOKIE['user_uuid'])) $uuid = $_COOKIE['user_uuid'];

    // Tenta pegar UUID via URL PATH_INFO
    if (isset($_SERVER['PATH_INFO'])) {
        $uuid = trim($_SERVER['PATH_INFO'], '/');
    }

    if ($uuid) {
        $user = $collection->findOne(['uuid' => $uuid]);
        if ($user) {
            $_SESSION['uuid'] = $user['uuid'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['is_admin'] = $user['is_admin'];
            return;
        }
    }

    // Se não achou usuário, redireciona para login
    header("Location: ../c/login.php");
    exit;
}
