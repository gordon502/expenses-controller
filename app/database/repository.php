<?php
require_once "../model/User.php";

final class Repository {
    private $pdo;

    public function __construct() {
        $this->pdo = $this->createDatabaseConnection();
    }

    private function createDatabaseConnection() : PDO {
        $pdo = new PDO('mysql:host=localhost;port=3306;dbname=expensescontroller', 'somequietguy', 'C1nszkieH@sl0');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public function testConnection() : bool {
        $this->pdo->query('SELECT * FROM users');
        return true;
    }

// TODO: change assigning to result login to User object
    public function findUserByLogin(string $login) : mixed {
        $result = false;

        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE login=:login');
        $stmt->execute(array(':login' => $login));
        while ($fetch = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new User(
                $fetch['id'],
                $fetch['login'],
                $fetch['email'],
                $fetch['salt'],
                $fetch['pass']
            );
        }

        return $result;
    }

// TODO: change assigning to result login to User object
    public function findUserByEmail(string $email) : mixed {
        $result = false;

        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email=:email');
        $stmt->execute(array(':email' => $email));
        while ($fetch = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new User(
                $fetch['id'],
                $fetch['login'],
                $fetch['email'],
                $fetch['salt'],
                $fetch['pass']
            );
        }

        return $result;
    }

}


