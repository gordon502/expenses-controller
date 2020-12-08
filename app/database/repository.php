<?php
require_once "configuration.php";

function testConnection() : bool {
    $pdo = createDatabaseConnection();
    $pdo->query('SELECT * FROM users');
    return true;
}

// TODO: change assigning to result login to User object
function findUserByLogin(string $login) : mixed {
    $result = false;

    $pdo = createDatabaseConnection();
    $stmt = $pdo->prepare('SELECT * FROM users WHERE login=:login');
    $stmt->execute(array(':login' => $login));
    while ($fetch = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $result = $fetch['login'];
    }

    return $result;
}

// TODO: change assigning to result login to User object
function findUserByEmail(string $email) : mixed {
    $result = false;

    $pdo = createDatabaseConnection();
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email=:email');
    $stmt->execute(array(':email' => $email));
    while ($fetch = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $result = $fetch['email'];
    }

    return $result;
}
