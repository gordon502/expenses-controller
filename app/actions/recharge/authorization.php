<?php
session_start();
require_once '../../model/User.php';
require_once '../../database/Repository.php';
require_once '../../model/Recharge.php';

//prevent from action [user not logged in]
if (!isset($_SESSION['user'])) {
    header('Location: ../../?do=login');
    return;
}

$logged_user = unserialize($_SESSION['user']);

// prevent from doing unauthorized action
if ($logged_user->getId() != $_POST['user_id']) {
    $_SESSION['error'] = 'You are not permitted for this action!';
    print_r($logged_user->getId());
    print_r($_POST['user_id']);
    header('Location: ../../?do=recharge');
    return;
}