<?php

require_once 'authorization.php';

$repository = new Repository();

$category = new Category(0, $_POST['name'], $_POST['user_id']);
$repository->insertCategory($category);

header('Location: ../../?do=bill');