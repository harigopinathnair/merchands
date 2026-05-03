<?php
require_once 'includes/db.php';

try {
    $pdo = getDbConnection();
    echo "<h1>Database Connection Successful!</h1>";
    echo "<p>Connected to: <b>nqatsxqe_merchands2026</b></p>";
    
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    echo "<h3>Available Tables:</h3><ul>";
    foreach ($tables as $table) {
        echo "<li>$table</li>";
    }
    echo "</ul>";
    
    if (in_array('leads', $tables)) {
        $cols = $pdo->query("DESCRIBE leads")->fetchAll();
        echo "<h3>'leads' Table Structure:</h3><table border='1' cellpadding='5'>";
        echo "<tr><th>Field</th><th>Type</th></tr>";
        foreach ($cols as $col) {
            echo "<tr><td>{$col['Field']}</td><td>{$col['Type']}</td></tr>";
        }
        echo "</table>";
    }

} catch (Exception $e) {
    echo "<h1 style='color:red;'>Database Connection Failed!</h1>";
    echo "<p>Error: " . $e->getMessage() . "</p>";
}
