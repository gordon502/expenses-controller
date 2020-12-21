<?php
session_start();

//prevent from action [already logged user]
if (isset($_SESSION['user'])) {
    header('Location: ../?do=overview');
    return;
}

$MIN_PASSWORD_LENGTH = 6;
$MAX_PASSWORD_LENGTH = 20;

if (!isset($_POST['reset'])) {
    header('Location: ../?do=login');
    return;
}

require_once '../database/repository.php';
require_once '../model/User.php';
$repository = new Repository();

$userFoundByLogin = $repository->findUserByLogin($_POST['login']);
$userFoundByEmail = $repository->findUserByEmail($_POST['email']);

//check if login and email exists in DB
if ($userFoundByEmail === false or $userFoundByLogin === false) {
    $_SESSION['error'] = 'Login or e-mail not found';
    header('Location: ../?do=reset');
    return;
}


// check if given login and e-mail are associated
if ($userFoundByLogin->getId() !== $userFoundByEmail->getId()) {
    $_SESSION['error'] = 'Login and e-mail have to be associated';
    header('Location: ../?do=reset');
    return;
}

$userIdFoundByResetCode = $repository->getUserIdByLastResetCode($_POST['code']);

// check if reset code is found in DB
if ($userIdFoundByResetCode === false) {
    $_SESSION['error'] = 'Wrong reset code';
    header('Location: ../?do=reset');
    return;
}

// check if given reset code is for this account
if ($userIdFoundByResetCode !== $userFoundByLogin->getId()) {
    $_SESSION['error'] = 'This code is not for this account';
    header('Location: ../?do=reset');
    return;
}

// check if passwords are the same
if ($_POST['password'] !== $_POST['passwordconf']) {
    $_SESSION['error'] = 'Password and its confirmation must be same!';
    header('Location: ../?do=reset');
    return;
}

// check password length
if (strlen($_POST['password']) < $MIN_PASSWORD_LENGTH or strlen($_POST['password']) > $MAX_PASSWORD_LENGTH) {
    $_SESSION['error'] = 'Password must be at least 6 and maximum 20 signs!';
    header('Location: ../?do=reset');
    return;
}


// generate new salt and set new password
$salt = hash('sha256', random_int(PHP_INT_MIN, PHP_INT_MAX));
$pass = hash('sha256', $salt . $_POST['password']);

$repository->changePasswordByUserId($userIdFoundByResetCode, $salt, $pass);
$repository->deactivateResetCodeByUserId($userIdFoundByResetCode);

$_SESSION['message'] = 'Password changed! Now please log in.';
header('Location: ../?do=login');






