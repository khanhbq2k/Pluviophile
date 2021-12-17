<?php

include_once("../../public/path.php");
include_once(ROOT_PATH . "/app/database/db.php");

$table = 'subscribers';
$errors = array();
$success = array();

$mail = json_decode(file_get_contents('php://input'), true);
$isValidEmail = filter_var($mail['email'], FILTER_VALIDATE_EMAIL);
if ($isValidEmail) {
    $existingEmail = selectOne($table, ['email' => $mail['email']]);
    if ($existingEmail) {
        array_push($errors, 'Email was already subscribed');
    } else {
        create($table, ['id' => uniqidReal(), 'email' => $mail['email']]);
        array_push($success, 'Email subscribed successfully');
    }
} else {
    array_push($errors, 'Please enter a valid email');
}

if(!empty($errors)){
    echo json_encode($errors);
}else{
    echo json_encode($success);
}