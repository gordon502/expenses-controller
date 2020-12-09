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
                $fetch['pass'],
                $fetch['active']
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
                $fetch['pass'],
                $fetch['active']
            );
        }

        return $result;
    }

    // return last inserted id
    public function addNewUser(User $user) : int{
        $stmt = $this->pdo->prepare('INSERT INTO users(login, email, salt, pass, active) ' .
                                                'VALUES(:login, :email, :salt, :pass, :active)');
        $stmt->execute(array(
            ':login' => $user->getLogin(),
            ':email' => $user->getEmail(),
            ':salt' => $user->getSalt(),
            ':pass' => $user->getPass(),
            ':active' => $user->getActive()
        ));

        return $this->pdo->lastInsertId();
    }

    public function addActivationLinkByUserId(int $userID, string $link) {
        $stmt = $this->pdo->prepare('INSERT INTO activation(link, user_id) VALUES (:link, :user_id)');
        $stmt->execute(array(':link' => $link, ':user_id' => $userID));
    }

}


