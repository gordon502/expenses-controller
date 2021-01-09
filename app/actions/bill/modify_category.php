<?php

require_once "authorization.php";

$repository = new Repository();
$category = new Category($_POST['id'], $_POST['name'], $_POST['user_id']);

$repository->modifyCategory($category);

header('Location: ../../?do=bill');