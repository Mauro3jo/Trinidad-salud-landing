<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function prestador_require_auth(): void {
    if (empty($_SESSION['prestador_token'])) {
        $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
        header('Location: ' . $base . '/login.php');
        exit;
    }
}

function prestador_token(): string {
    return $_SESSION['prestador_token'] ?? '';
}

function prestador_user(): array {
    return $_SESSION['prestador_user'] ?? [];
}

function prestador_name(): string {
    return prestador_user()['name'] ?? 'Prestador';
}
