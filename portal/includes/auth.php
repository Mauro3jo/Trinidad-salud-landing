<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function portal_require_auth(): void {
    if (empty($_SESSION['portal_token'])) {
        $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
        header('Location: ' . $base . '/login.php');
        exit;
    }
}

function portal_token(): string {
    return $_SESSION['portal_token'] ?? '';
}

function portal_user(): array {
    return $_SESSION['portal_user'] ?? [];
}

function portal_user_name(): string {
    $u = portal_user();
    // MobileUser has profile.Nombres / profile.Apellido
    $p = $u['profile'] ?? [];
    $n = trim(($p['Nombres'] ?? '') . ' ' . ($p['Apellido'] ?? ''));
    return $n ?: 'Usuario';
}
