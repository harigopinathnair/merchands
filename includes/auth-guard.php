<?php
// merchands/includes/auth-guard.php

// Secure session config
ini_set('session.cookie_httponly', 1);
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    ini_set('session.cookie_secure', 1);
}
ini_set('session.cookie_samesite', 'Lax');
ini_set('session.use_strict_mode', 1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$SESSION_TIMEOUT = 8 * 60 * 60; // 8 hours

// Check session exists
if (empty($_SESSION['admin_id'])) {
    session_destroy();
    header('Location: login.php?error=not_logged_in');
    exit;
}

// Check session timeout
if (!empty($_SESSION['login_time']) && (time() - $_SESSION['login_time']) > $SESSION_TIMEOUT) {
    session_destroy();
    header('Location: login.php?error=session_expired');
    exit;
}

// Verify admin still exists and is active in DB
$pdo = getDbConnection();
$stmt = $pdo->prepare('SELECT id, username, full_name FROM admin_users WHERE id = ? AND is_active = 1');
$stmt->execute([$_SESSION['admin_id']]);
$admin = $stmt->fetch();

if (!$admin) {
    session_destroy();
    header('Location: login.php?error=account_disabled');
    exit;
}

// Refresh session time and update last_login
$_SESSION['login_time'] = time();
$_SESSION['admin_user'] = $admin['username'];
$_SESSION['admin_name'] = $admin['full_name'];

$pdo->prepare('UPDATE admin_users SET last_login = NOW() WHERE id = ?')
    ->execute([$_SESSION['admin_id']]);
