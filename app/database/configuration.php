<?php
function createDatabaseConnection() : PDO {
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=expensescontroller', 'somequietguy', 'C1nszkieH@sl0');
    //$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}
