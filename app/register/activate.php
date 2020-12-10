<?php
session_start();

// check if parameter is given
if (!isset($_GET['code'])) {
    header('Location: ../?do=register');
    return;
}

require_once "../database/repository.php";
$repository = new Repository();

$activationResult = $repository->activateUserByLink($_GET['code']);

if ($activationResult) {
    $_SESSION['error'] = 'Activation successful! Now please log in!';
    header("Location: ../?do=login");
    return;
}

else {
    $_SESSION['error'] = 'Activation unsuccessful. Are you sure that was the right link or account is already active?';
    header("Location: ../?do=register");
    return;
}



