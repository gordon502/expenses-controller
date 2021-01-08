<?php
require_once 'authorization.php';

// check user required input
if (empty($_POST['startdate']) or empty($_POST['amount'])) {
    $_SESSION['error'] = 'Start date and amount are required fields!';
    header('Location: ../../?do=recharge');
    return;
}

$repository = new Repository();

$enddate = !empty($_POST['enddate']) ? $_POST['enddate'] : null;
$recharge = new Recharge(0, $_POST['user_id'], $_POST['amount'], $_POST['startdate'], $enddate);

$repository->insertRecharge($recharge);

header('Location: ../../?do=recharge');

