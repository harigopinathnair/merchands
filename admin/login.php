<?php
// merchands/admin/login.php

require_once '../includes/db.php';

session_start();

// Redirect if already logged in
if (!empty($_SESSION['admin_id'])) {
    header('Location: /admin/');
    exit;
}

// CSRF protection
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF check
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'] ?? '')) {
        $error = 'Invalid request. Please try again.';
    } else {
        // Rate limiting logic
        if (!isset($_SESSION['failed_attempts'])) $_SESSION['failed_attempts'] = 0;
        if (!isset($_SESSION['lockout_until'])) $_SESSION['lockout_until'] = 0;

        if (time() < $_SESSION['lockout_until']) {
            $minutesLeft = ceil(($_SESSION['lockout_until'] - time()) / 60);
            $error = "Too many failed attempts. Try again in {$minutesLeft} minute(s).";
        } else {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            $pdo = getDbConnection();
            $stmt = $pdo->prepare('SELECT * FROM admin_users WHERE username = ? AND is_active = 1');
            $stmt->execute([$username]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password_hash'])) {
                // Success
                session_regenerate_id(true);
                $_SESSION['admin_id']    = $user['id'];
                $_SESSION['admin_user']  = $user['username'];
                $_SESSION['admin_name']  = $user['full_name'];
                $_SESSION['login_time']  = time();
                $_SESSION['failed_attempts'] = 0;
                
                $pdo->prepare('UPDATE admin_users SET last_login = NOW() WHERE id = ?')->execute([$user['id']]);
                
                header('Location: /admin/');
                exit;
            } else {
                // Fail
                $_SESSION['failed_attempts']++;
                if ($_SESSION['failed_attempts'] >= 3) sleep(1);
                if ($_SESSION['failed_attempts'] >= 5) {
                    $_SESSION['lockout_until'] = time() + (15 * 60);
                    $error = 'Too many failed attempts. Locked for 15 minutes.';
                } else {
                    $error = 'Invalid username or password.';
                }
            }
        }
    }
}

// Handle URL errors
$urlError = $_GET['error'] ?? '';
if ($urlError === 'not_logged_in') $error = 'Please sign in to continue.';
if ($urlError === 'session_expired') $error = 'Your session has expired. Please sign in again.';
if ($urlError === 'account_disabled') $error = 'This account has been disabled.';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Merchands.com</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy: #0A2240;
            --cta-orange: #E8620A;
            --white: #FFFFFF;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--navy);
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .login-card {
            background: var(--white);
            max-width: 400px;
            width: 90%;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            text-align: center;
        }

        .logo { font-size: 1.5rem; font-weight: 700; color: var(--navy); margin-bottom: 30px; display: block; }
        h2 { font-size: 1.25rem; color: var(--navy); margin-bottom: 25px; }

        .form-group { text-align: left; margin-bottom: 20px; position: relative; }
        label { display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 8px; color: #444; }
        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            box-sizing: border-box;
        }

        .form-control:focus { outline: none; border-color: var(--navy); }

        .btn-login {
            width: 100%;
            height: 48px;
            background: var(--cta-orange);
            color: var(--white);
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-login:hover { filter: brightness(1.1); }

        .error-area {
            background: #fff5f5;
            color: #c53030;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 0.875rem;
            display: <?= $error ? 'block' : 'none' ?>;
        }

        .footer-text { margin-top: 30px; color: rgba(255,255,255,0.5); font-size: 0.75rem; }

        .toggle-pw {
            position: absolute;
            right: 12px;
            top: 40px;
            cursor: pointer;
            color: #888;
        }
    </style>
</head>
<body>

    <div>
        <div class="login-card">
            <span class="logo">Merchands.com</span>
            <h2>Admin sign in</h2>

            <?php if ($error): ?>
            <div class="error-area"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required autofocus>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                    <span class="toggle-pw" onclick="togglePassword()">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </span>
                </div>

                <button type="submit" class="btn-login">Sign in</button>
            </form>
        </div>
        <div class="footer-text" style="text-align: center;">&copy; 2026 Merchands.com</div>
    </div>

    <script>
        function togglePassword() {
            const pw = document.getElementById('password');
            pw.type = pw.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>
</html>
