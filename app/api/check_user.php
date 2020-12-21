<?php
/***
 * This endpoint allows user to check, if given user by e-mail, username
 * or both exists.
 */
header('Content-type: application/json');

// check if any parameter was given in request, if not return false in JSON
if (!isset($_GET['login']) and !isset($_GET['email'])) {
    echo json_encode(array(
        'exists' => false,
        'message' => 'Parameters were not given!'));
    return;
}


require_once '../database/Repository.php';
require_once '../model/User.php';
$repository = new Repository();

// find users in db
if (isset($_GET['login'])) {
    $userFoundByLogin = $repository->findUserByLogin($_GET['login']);
}
if (isset($_GET['email'])) {
    $userFoundByEmail = $repository->findUserByEmail($_GET['email']);
}

// check for request with both params
if (isset($userFoundByLogin, $userFoundByEmail)) {

    // if any SELECT in database returned no row
    if ($userFoundByLogin === false or $userFoundByEmail === false) {
        echo json_encode(array(
            'exists' => false,
            'message' => 'User with given login and e-mail doesn\'t exist'
        ));
        return;
    }

    if ($userFoundByLogin->getId() === $userFoundByEmail->getId()) {
        echo json_encode(array(
            'exists' => true,
            'message' => 'User with given e-mail and login exists!'
        ));
        return;
    }
    else {
        echo json_encode(array(
            'exists' => false,
            'message' => 'Given login and e-mail are not associated!'
        ));
        return;
    }

}


// request with only one param [login]
if (isset($userFoundByLogin)) {
    $exists = $userFoundByLogin ? true : false;
    $message = $userFoundByLogin ? 'User with given login exists!' : 'User with given login doesn\'t exist';
    echo json_encode(array('exists' => $exists, 'message' => $message));
    return;
}
else if (isset($userFoundByEmail)) {
    $exists = $userFoundByEmail ? true : false;
    $message = $userFoundByEmail ? 'User with given email exists!' : 'User with given email doesn\'t exist';
    echo json_encode(array('exists' => $exists, 'message' => $message));
    return;
}







