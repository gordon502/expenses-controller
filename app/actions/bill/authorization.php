<?php
session_start();
require_once '../../model/User.php';
require_once '../../database/Repository.php';
require_once '../../model/Recharge.php';
require_once '../../model/Category.php';

//prevent from action [user not logged in]
if (!isset($_SESSION['user'])) {
    header('Location: ../../?do=login');
    return;
}

$logged_user = unserialize($_SESSION['user']);

// prevent from doing unauthorized action
if ($logged_user->getId() != $_POST['user_id']) {
    $_SESSION['error'] = 'You are not permitted for this action!';
    header('Location: ../../?do=bill');
    return;
}