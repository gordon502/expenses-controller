<?php
require_once "configuration.php";

function testConnection() : bool {
    $pdo = createDatabaseConnection();
    $pdo->query('SELECT * FROM users');
    return true;
}
