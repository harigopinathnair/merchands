<?php
// merchands/api/login.php

header('Content-Type: application/json');
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method Not Allowed']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
if (!$input) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
    exit;
}

$user_input = trim($input['user'] ?? '');
$password   = $input['password'] ?? '';

if (!$user_input || !$password) {
    http_response_code(422);
    echo json_encode(['success' => false, 'error' => 'Username/Email and password are required']);
    exit;
}

// Secure session setup
ini_set('session.cookie_httponly', 1);
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    ini_set('session.cookie_secure', 1);
}
ini_set('session.cookie_samesite', 'Strict');
ini_set('session.use_strict_mode', 1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    $pdo  = getDbConnection();

    // Try admin_users first (by username or email)
    $stmt = $pdo->prepare('SELECT id, username, full_name, password_hash FROM admin_users WHERE (username = ? OR email = ?) AND is_active = 1');
    $stmt->execute([$user_input, $user_input]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['admin_id']   = $admin['id'];
        $_SESSION['admin_user'] = $admin['username'];
        $_SESSION['admin_name'] = $admin['full_name'];
        $_SESSION['login_time'] = time();

        $pdo->prepare('UPDATE admin_users SET last_login = NOW() WHERE id = ?')->execute([$admin['id']]);

        echo json_encode(['success' => true, 'redirect' => 'admin/', 'role' => 'admin']);
        exit;
    }

    // Fall back to users table
    $stmt = $pdo->prepare('SELECT id, full_name, email, password_hash, role FROM users WHERE email = ? AND is_active = 1');
    $stmt->execute([$user_input]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['user_id']   = $user['id'];
        $_SESSION['user_name'] = $user['full_name'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['login_time'] = time();

        echo json_encode(['success' => true, 'redirect' => './', 'role' => $user['role']]);
        exit;
    }

    // Invalid credentials — same error for both cases (no enumeration)
    http_response_code(401);
    echo json_encode(['success' => false, 'error' => 'Invalid credentials']);

} catch (PDOException $e) {
    error_log('Login error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Server error. Please try again.']);
}
