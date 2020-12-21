<?php

function checkPermissions(string $action, bool $isUserLogged) : bool {
    $unlogged_actions = array('login', 'register', 'reset');
    $logged_actions = array('overview', 'bills', 'recharges', 'account');

    if ($isUserLogged) {
        if (in_array($action, $logged_actions))
            return true;
        return false;
    }

    else {
        if (in_array($action, $unlogged_actions))
            return true;
        return false;
    }
}

session_start();
$header = '123.php';
$content = '123.php';


// set which header and content load depend on GET 'do' param
if (isset($_GET['do'])) {
    $permission = checkPermissions($_GET['do'], isset($_SESSION['user']));
    if (!$permission) {
        if (isset($_SESSION['user'])) {
            header('Location: ?do=overview');
            return;
        }
        else {
            header('Location: ?do=login');
            return;
        }
    }

    $header = "$_GET[do]/view/header.php";
    $content = "$_GET[do]/view/content.php";
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A layout example with a side menu that hides on mobile, just like the Pure website.">
    <title>Expenses controller</title>
    <link rel="stylesheet" href="pure/pure-min.css">
    <link rel="stylesheet" href="pure/side-menu.css">
</head>
<body>
<script src="pure/jquery-3.5.1.min.js"></script>
<div id="layout">
    <!-- Menu toggle -->
    <a href="#menu" id="menuLink" class="menu-link">
        <!-- Hamburger icon -->
        <span></span>
    </a>

    <div id="menu">
        <div class="pure-menu">
            <a class="pure-menu-heading" href="#"><?php
                if (isset($_SESSION['user']))
                    echo 'Welcome'; // logged user
                else
                    echo 'unlogged';
                ?></a>

            <ul class="pure-menu-list">
                <?php
                if (isset($_SESSION['user'])) echo
                    '
                     <li class="pure-menu-item"><a href="?do=overview" class="pure-menu-link">Overview</a></li>
                     <li class="pure-menu-item"><a href="?do=bills" class="pure-menu-link">Bills</a></li>
                     <li class="pure-menu-item"><a href="?do=recharges" class="pure-menu-link">Recharges</a></li>
                     <li class="pure-menu-item"><a href="?do=account" class="pure-menu-link">Account</a></li>
                     <li class="pure-menu-item"><a href="logout.php" class="pure-menu-link">Logout</a></li>';
                else echo
                    '<li class="pure-menu-item menu-item-divided"><a href="?do=login" class="pure-menu-link">Login</a></li>
                     <li class="pure-menu-item"><a href="?do=register" class="pure-menu-link">Register</a></li>';
                ?>
            </ul>
        </div>
    </div>

    <div id="main">
        <div class="header">
            <?php include $header; ?>
        </div>

        <div class="content">
            <?php include $content; ?>
        </div>
    </div>
</div>
<script src="pure/ui.js"></script>
</body>
</html>
