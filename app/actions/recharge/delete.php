<?php
require_once 'authorization.php';
$repository = new Repository();

$repository->deleteRecharge($_POST['recharge_id'], $_POST['user_id']);

header('Location: ../../?do=recharge');
return;