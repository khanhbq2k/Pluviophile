<?php 

/**
 * Middleware function to check user's authority
 *
 * @param string $redirect Redirect to index page
 */
function usersOnly($redirect = '/public/index.php')
{
    if(empty($_SESSION['id'])){
        header('location: ' . BASE_URL . $redirect);
        exit(0);
    }
}

/**
 * Middleware function to check admin's authority
 *
 * @param string $redirect Redirect to index page
 */
function adminOnly($redirect = '/public/index.php')
{
    if(empty($_SESSION['id']) || empty($_SESSION['admin'])){
        header('location: ' . BASE_URL . $redirect);
        exit(0);
    }
}

/**
 * Middleware function to check guest's authority
 *
 * @param string $redirect Redirect to index page
 */
function guestsOnly($redirect = '/public/index.php')
{
    if(isset($_SESSION['id'])){
        header('location: ' . BASE_URL . $redirect);
        exit(0);
    }
}