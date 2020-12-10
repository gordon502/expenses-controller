<?php
session_start();
$header = '123.php';
$content = '123.php';

// set which header and content load depend on GET 'do' param
if (isset($_GET['do'])) {
    $header = htmlentities($_GET['do']) . "/view/header.php";
    $content = htmlentities($_GET['do']) . '/view/content.php';
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

<div id="layout">
    <!-- Menu toggle -->
    <a href="#menu" id="menuLink" class="menu-link">
        <!-- Hamburger icon -->
        <span></span>
    </a>

    <div id="menu">
        <div class="pure-menu">
            <a class="pure-menu-heading" href="#">Unlogged</a>

            <ul class="pure-menu-list">
                <li class="pure-menu-item menu-item-divided"><a href="?do=login" class="pure-menu-link">Login</a></li>
                <li class="pure-menu-item"><a href="?do=register" class="pure-menu-link">Register</a></li>
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
