<?php
// params in request must be given
if (!isset($_GET['login']) or !isset($_GET['email'])) {
    echo json_encode(array(
        'success' => false,
        'message' => 'Login and email are required!'));
    return;
}

require_once '../database/repository.php';
$repository = new Repository();


$code = strval(random_int(100000, 999999));

$result = $repository->addResetCodeByLoginAndEmail($_GET['login'], $_GET['email'], $code);

if ($result) {
    echo json_encode(array(
        'success' => true,
        'message' => 'Code generated! Please check email!'
    ));
    return;
}
else {
    echo json_encode(array(
        'success' => false,
        'message' => 'Code not generated. Please validate your input!'
    ));
    return;
}

// TODO: SEND RESET CODE TO EMAIL
