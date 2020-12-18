<?php
session_start();
$MIN_LOGIN_LENGTH = 8;
$MAX_LOGIN_LENGTH = 45;
$MIN_PASSWORD_LENGTH = 6;
$MAX_PASSWORD_LENGTH = 20;

function checkUserInput(string $username, string $password) : bool {
    global $MIN_LOGIN_LENGTH, $MAX_LOGIN_LENGTH, $MIN_PASSWORD_LENGTH, $MAX_PASSWORD_LENGTH;

    // check if login length matches in interval
    if (strlen($username) < $MIN_LOGIN_LENGTH or strlen($username) > $MAX_LOGIN_LENGTH) {
        $_SESSION['error'] = "Login must have minimum $MIN_LOGIN_LENGTH and maximum $MAX_LOGIN_LENGTH in length.";
        return false;
    }

    // check if password length matches in interval
    if (strlen($password) < $MIN_PASSWORD_LENGTH or strlen($password) > $MAX_PASSWORD_LENGTH) {
        $_SESSION['error'] = "Password must have minimum $MIN_PASSWORD_LENGTH and maximum $MAX_PASSWORD_LENGTH in length.";
        return false;
    }

    return true;
}

// check if login form was sended
if (!isset($_POST['login'])) {
    header('Location: ../?do=login');
    return;
}


// check if given username and password match constraints
if (!checkUserInput($_POST['username'], $_POST['password'])) {
    header('Location: ../?do=login');
    return;
}

require_once '../database/repository.php';
require_once '../model/User.php';
$repository = new Repository();

$user = $repository->findUserByLogin($_POST['username']);

// check if user exists
if (!$user) {
    $_SESSION['error'] = 'User with given login doesn\'t exists!';
    header("Location: ../?do=login");
    return;
}

if (!$user->getActive()) {
    $_SESSION['error'] = 'Account not active! Please go to your mail and click activation link!';
    header('Location: ../?do=login');
    return;
}

// check password
$calculated_hash = hash('sha256', $user->getSalt() . $_POST['password']);
if ($calculated_hash === $user->getPass()) {
    $_SESSION['error'] = 'Login successful!';
    header('Location: ../?do=login');
    return;
}
else {
    $_SESSION['error'] = 'Wrong password!';
    header('Location: ../?do=login');
    return;
}