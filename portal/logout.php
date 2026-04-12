<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/api.php';

if (!empty($_SESSION['portal_token'])) {
    api_post('/logout', [], portal_token());
}

$_SESSION = [];
session_destroy();

header('Location: login.php');
exit;
