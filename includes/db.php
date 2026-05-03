<?php
// merchands/includes/db.php

function getDbConnection(): PDO {
    $isLocal = (
        isset($_SERVER['SERVER_NAME']) &&
        in_array($_SERVER['SERVER_NAME'], ['localhost', '127.0.0.1', '::1'])
    ) || php_uname('n') === 'localhost';

    if ($isLocal) {
        $host   = 'localhost';
        $dbName = 'nqatsxqe_merchands2026';
        $user   = 'root';
        $pass   = '';
        $port   = '3306';
    } else {
        $host   = 'localhost';
        $dbName = 'nqatsxqe_merchands2026';
        $user   = 'nqatsxqe_2026merchands';
        $pass   = 'Rankmonk_123@';
        $port   = '3306';
    }

    static $pdo = null;
    if ($pdo !== null) return $pdo;

    try {
        $dsn = "mysql:host={$host};port={$port};dbname={$dbName};charset=utf8mb4";
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
        return $pdo;
    } catch (PDOException $e) {
        if (!headers_sent()) {
            http_response_code(500);
            header('Content-Type: application/json');
        }
        error_log('DB connection failed: ' . $e->getMessage());
        die(json_encode(['success' => false, 'error' => 'Database unavailable']));
    }
}
