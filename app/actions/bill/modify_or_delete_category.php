<?php

require_once "authorization.php";

$repository = new Repository();
$category = new Category($_POST['id'], $_POST['name'], $_POST['user_id']);

if (isset($_POST['modify']))
    $repository->modifyCategory($category);
elseif (isset($_POST['delete']))
    $repository->deleteCategory($category);
header('Location: ../../?do=bill');