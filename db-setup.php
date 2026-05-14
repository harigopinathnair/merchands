<?php
// merchands/db-setup.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'includes/db.php';

echo "<h2>Database Setup Tool</h2>";

function runSqlFile($pdo, $filePath) {
    if (!file_exists($filePath)) {
        echo "<p style='color:red;'>❌ File not found: $filePath</p>";
        return;
    }

    $sql = file_get_contents($filePath);
    
    // Simple split by semicolon (not perfect for all cases but works for standard CREATE/INSERT)
    // We filter out empty queries and USE statements
    $queries = array_filter(array_map('trim', explode(';', $sql)));
    
    $success = 0;
    $errors = 0;

    foreach ($queries as $query) {
        if (empty($query)) continue;
        if (stripos($query, 'USE ') === 0) continue; // Skip USE database; commands
        
        try {
            $pdo->exec($query);
            $success++;
        } catch (PDOException $e) {
            echo "<p style='color:orange;'>⚠️ Error executing query: " . substr($query, 0, 50) . "... <br><em>" . $e->getMessage() . "</em></p>";
            $errors++;
        }
    }

    echo "<p><strong>Finished $filePath:</strong> $success succeeded, $errors errors/notices.</p>";
}

try {
    $pdo = getDbConnection();
    echo "<p style='color:green;'>✅ Connected to database.</p>";
    
    echo "<h3>Running Schema...</h3>";
    runSqlFile($pdo, 'database/schema.sql');
    
    echo "<h3>Running Migrations...</h3>";
    runSqlFile($pdo, 'database/migrate.sql');
    
    echo "<hr><p style='color:green; font-weight:bold;'>✅ Setup complete. Please try logging in at /admin/login.php now.</p>";
    echo "<p style='color:red; font-weight:bold;'>⚠️ DELETE THIS FILE (db-setup.php) FROM YOUR SERVER NOW.</p>";

} catch (Exception $e) {
    echo "<p style='color:red;'>❌ Connection Failed: " . $e->getMessage() . "</p>";
}
