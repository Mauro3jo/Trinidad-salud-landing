<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/api.php';

if (!empty($_SESSION['prestador_token'])) {
    @papi_post('/logout', [], $_SESSION['prestador_token']);
}

session_destroy();
header('Location: login.php');
exit;
