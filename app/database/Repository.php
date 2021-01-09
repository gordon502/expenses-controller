<?php
//require_once "../model/User.php";

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

    public function findUserByLogin(string $login) : User|false {
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

    public function findUserByEmail(string $email) : User|false {
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

    public function findUserByLoginAndEmail(string $login, string $email) : User|false {
        $result = false;

        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE login=:login and email=:email');
        $stmt->execute(array(
            ':login' => $login,
            ':email' => $email
        ));
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

    /**
     * This function will set active in users table to 1 if link given in GET param is found and
     * also delete corresponding record in activation table.
     * @param string $link activation link
     * @return bool result of the operation
     */
    public function activateUserByLink(string $link) : bool {
        $result = false;
        $ids = array();

        $stmt = $this->pdo->prepare('SELECT user_id FROM activation WHERE link=:link');
        $stmt->execute(array(':link' => $link));
        while ($id = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $ids[] = $id['user_id'];
        }

        // set accounts to active and then delete activation links
        foreach ($ids as $id) {
            $this->pdo->query("UPDATE users SET active=1 WHERE id=$id");
            $result = true;
            $this->pdo->query("DELETE FROM activation WHERE user_id=$id");
        }

        return $result;
    }

    public function getUserIdByLastResetCode(string $code) : int|false {
        $user = false;
        $stmt = $this->pdo->prepare('SELECT user_id, created_at FROM reset WHERE used=0 and code = :code order by created_at');
        $stmt->execute(array(':code' => $code));

        while ($id = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $user = $id['user_id'];
        }

        return $user;
    }

    public function changePasswordByUserId(int $id, string $salt, string $pass) {
        $stmt = $this->pdo->prepare('UPDATE users SET salt = :salt, pass = :pass WHERE id = :id');
        $stmt->execute(array(
            ':salt' => $salt,
            ':pass' => $pass,
            ':id' => $id
        ));
    }

    public function addResetCodeByLoginAndEmail(string $login, string $email, string $code) : bool {
        $user = $this->findUserByLoginAndEmail($login, $email);
        if ($user === false) {
            return false;
        }

        $stmt = $this->pdo->prepare('INSERT INTO reset(user_id, code, created_at, used)' .
            'VALUES(:user_id, :code, :created_at, :used)');
        $stmt->execute(array(
            ':user_id' => $user->getId(),
            ':code' => $code,
            ':created_at' => date("Y-m-d H:i:s"),
            'used' => false
        ));

        return true;
    }

    public function deactivateResetCodeByUserId(int $id) {
        $stmt = $this->pdo->prepare('UPDATE reset SET used=1 WHERE user_id = :id');
        $stmt->execute(array(':id' => $id));
    }

    public function getRechargesByUserId(int $user_id) : array {
        $recharges = array();
        $stmt = $this->pdo->prepare('SELECT * FROM recharge WHERE user_id=:user_id');
        $stmt->execute(array(':user_id' => $user_id));

        while($recharge = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $recharges[] = new Recharge(
                $recharge['id'],
                $recharge['user_id'],
                $recharge['amount'],
                $recharge['start_date'],
                $recharge['end_date']
            );
        }

        return $recharges;
    }

    public function insertRecharge(Recharge $recharge) {
        $stmt = $this->pdo->prepare('INSERT INTO recharge(user_id, amount, start_date, end_date) VALUES' .
                                                '(:user_id, :amount, :start_date, :end_date)');
        $stmt->execute(array(
            ':user_id' => $recharge->getUserId(),
            ':amount' => $recharge->getAmount(),
            ':start_date' => $recharge->getStartDate(),
            ':end_date' => $recharge->getEndDate()
            ));
    }

    public function deleteRecharge(int $recharge_id, int $user_id) {
        $stmt = $this->pdo->prepare('DELETE FROM recharge WHERE id=:recharge_id and user_id=:user_id');

        $stmt->execute(array(
            ':recharge_id' => $recharge_id,
            ':user_id' => $user_id));
    }

    public function getCategoriesByUserId(int $user_id) : array {
        $categories = array();

        $stmt = $this->pdo->prepare('SELECT * FROM loads WHERE user_id=:user_id');
        $stmt->execute(array(':user_id' => $user_id));

        while ($category = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $categories[] = new Category()
        }
    }
}


