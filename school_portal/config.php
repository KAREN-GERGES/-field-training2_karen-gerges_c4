<?php
declare(strict_types=1);

$host = 'localhost';
$dbname = 'school_db';
$dbUser = 'root';
$dbPassword = '';

try {
    $pdo = new PDO(
        "mysql:host={$host};dbname={$dbname};charset=utf8mb4",
        $dbUser,
        $dbPassword,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $e) {
    // Log the detailed error on the server; do not expose it to visitors.
    error_log($e->getMessage());
    http_response_code(500);
    exit('Could not connect to the database. Check your database settings.');
}
