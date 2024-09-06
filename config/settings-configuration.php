<?php 
    session_start();

    //error reporting
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //CSRF TOKEN
    if(empty($_SESSION['csrf_token'])) {
        $crsf_token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    } else {
        $crsf_token = $_SESSION['csrf_token'];
    }
?>