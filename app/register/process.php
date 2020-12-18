<?php
session_start();
$MIN_LOGIN_LENGTH = 8;
$MAX_LOGIN_LENGTH = 45;
$MIN_PASSWORD_LENGTH = 6;
$MAX_PASSWORD_LENGTH = 20;
$confirmation_link = 'http://localhost/expenses-controller/app/register/activate.php?code=';


function checkUserInput(string $login, string $password, string $passwordconf, string $email) : bool {
    global $MIN_LOGIN_LENGTH, $MAX_LOGIN_LENGTH, $MIN_PASSWORD_LENGTH, $MAX_PASSWORD_LENGTH;

    // check if login length matches in interval
    if (strlen($login) < $MIN_LOGIN_LENGTH or strlen($login) > $MAX_LOGIN_LENGTH) {
        $_SESSION['error'] = "Login must have minimum $MIN_LOGIN_LENGTH and maximum $MAX_LOGIN_LENGTH in length.";
        return false;
    }

    // check if password length matches in interval
    if (strlen($password) < $MIN_PASSWORD_LENGTH or strlen($password) > $MAX_PASSWORD_LENGTH) {
        $_SESSION['error'] = "Password must have minimum $MIN_PASSWORD_LENGTH and maximum $MAX_PASSWORD_LENGTH in length.";
        return false;
    }

    // check if password and confirmations are equal
    if ($password !== $passwordconf) {
        $_SESSION['error'] = 'Password and its confirmation must be the same!';
        return false;
    }

    // validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Given email has not proper format.';
        return false;
    }

    return true;
}

/* RIGHT SCRIPT */

// check if form was sended, if not redirect back to register page
if (!isset($_POST['register'])) {
    header('Location: ../?do=register');
    return;
}

// validate if user input match constraints
if (!checkUserInput($_POST['login'], $_POST['password'], $_POST['passwordconf'], $_POST['email'])) {
    header('Location: ../?do=register');
    return;
}

require_once "../database/repository.php";
require_once "../model/User.php";
$repository = new Repository();

// check if given user already exists
if ($repository->findUserByLogin($_POST['login'])) {
    $_SESSION['error'] = 'User with given login already exists!';
    header('Location: ../?do=register');
    return;
}

// check if given mail is already used
if ($repository->findUserByEmail($_POST['email'])) {
    $_SESSION['error'] = 'Given email is already taken!';
    header('Location: ../?do=register');
    return;
}



// generate safe salt and hashes
$salt = hash('sha256', strval(random_int(1000000, PHP_INT_MAX)));
$pass = hash('sha256', $salt . $_POST['password']);

// Add new user and create activation link
$insertedID = $repository->addNewUser(new User(0, $_POST['login'], $_POST['email'], $salt, $pass, 0));

$hash = hash('md5', strval(random_int(PHP_INT_MIN, PHP_INT_MAX)));
$link = substr($hash, 0, 30);
$repository->addActivationLinkByUserId($insertedID, $link);

$_SESSION['message'] = 'Register done! We send you activation link to your email account.';
header('Location: ../?do=register');



// send activation link to email
$to_email = $_POST['email'];
$subject = 'Welcome to expenses controller!';
$body = "To finish account activation, please click link: " . $confirmation_link . $link;

mail($to_email, $subject, $body);


