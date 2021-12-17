<?php

/**
 * Validate data fields when create or update a user
 *
 * @param string  $user   Given object holding user data fields to be validated
 * @return array          An array holding all the errors, empty array is no errors found
 */
function validateUser($user)
{
    $errors = array();

    if (empty($user['username'])) {
        array_push($errors, 'Username is required');
    }
    if (empty($user['email'])) {
        array_push($errors, 'Email is required');
    }
    if (empty($user['password'])) {
        array_push($errors, 'Password is required');
    }
    if ($user['passwordConf'] !== $user['password']) {
        array_push($errors, 'Those passwords didn\'t match, please try again');
    }

    $existingUser = selectOne('users', ['email' => $user['email']]);
    if ($existingUser) {
        if(isset($user['update-user']) && $existingUser['id'] != $user['id']){
            array_push($errors, 'Email already exists');
        }else if(isset($user['register-btn']) || isset($user['add-user'])){
            array_push($errors, 'Email already exists');
        }
    }

    $existingUsername = selectOne('users', ['username' => $user['username']]);
    if($existingUsername){
        if(isset($user['update-user']) && $existingUsername['id'] != $user['id']){
            array_push($errors, 'Username already exists');
        }else if(isset($user['register-btn']) || isset($user['add-user'])){
            array_push($errors, 'Username already exists');
        }
    }

    if(strlen($user['password']) < 8){
        array_push($errors, 'Password should be at least 8 characters in length');
    }

    return $errors;
}

/**
 * Validate data fields when user login
 *
 * @param string  $user   Given object holding user data fields to be validated
 * @return array          An array holding all the errors, empty array is no errors found
 */
function validateLogin($user)
{
    $errors = array();

    if (empty($user['username'])) {
        array_push($errors, 'Username is required');
    }

    if (empty($user['password'])) {
        array_push($errors, 'Password is required');
    }

    return $errors;
}
