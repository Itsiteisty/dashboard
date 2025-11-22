<?php
// auth.php
session_start();

/**
 * Login do admin
 * @param string $password
 * @return bool
 */
function login(string $password): bool {
    // Pegando senha do admin do ENV (Render)
    $adminPassword = getenv('ADMIN_PASSWORD');

    if ($password === $adminPassword) {
        $_SESSION['logged_in'] = true;
        $_SESSION['login_time'] = time(); // Pode ser útil para expiração
        return true;
    }

    return false;
}

/**
 * Logout do admin
 */
function logout(): void {
    unset($_SESSION['logged_in']);
    unset($_SESSION['login_time']);
    session_destroy();
}

/**
 * Verifica se o admin está logado
 * @return bool
 */
function isLoggedIn(): bool {
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

/**
 * Protege páginas que só admin pode acessar
 */
function requireAdmin(): void {
    if (!isLoggedIn()) {
        header('Location: index.php'); // Redireciona para login
        exit;
    }
}
