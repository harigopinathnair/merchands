<?php
// merchands/test-db.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'includes/db.php';

echo "<h2>Database Diagnostics</h2>";

try {
    $pdo = getDbConnection();
    echo "<p style='color:green;'>✅ Connection Successful!</p>";
    
    $stmt = $pdo->query("SHOW TABLES LIKE 'admin_users'");
    if ($stmt->fetch()) {
        echo "<p style='color:green;'>✅ 'admin_users' table exists.</p>";
        
        $count = $pdo->query("SELECT COUNT(*) FROM admin_users")->fetchColumn();
        echo "<p style='color:green;'>✅ Total admin users: $count</p>";
    } else {
        echo "<p style='color:red;'>❌ 'admin_users' table is MISSING. Please run database/schema.sql on your live server.</p>";
    }
    
} catch (Exception $e) {
    echo "<p style='color:red;'>❌ Connection Failed: " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><strong>Details:</strong> Current Environment Detection -> " . (isset($_SERVER['REMOTE_ADDR']) && in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']) ? 'Local' : 'Live') . "</p>";
}
