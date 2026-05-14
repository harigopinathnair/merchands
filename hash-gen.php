<?php
// merchands/hash-gen.php
if (!isset($_GET['pass'])) {
    die("Usage: hash-gen.php?pass=YOUR_NEW_PASSWORD");
}

$password = $_GET['pass'];
$hash = password_hash($password, PASSWORD_DEFAULT);

echo "<h2>Password Hash Generator</h2>";
echo "<p><strong>Password:</strong> " . htmlspecialchars($password) . "</p>";
echo "<p><strong>Hash:</strong> <code style='background:#eee; padding:5px;'>" . $hash . "</code></p>";
echo "<hr>";
echo "<p>Copy the hash above into your SQL query:</p>";
echo "<pre>UPDATE admin_users SET password_hash = '$hash' WHERE username = 'admin';</pre>";
