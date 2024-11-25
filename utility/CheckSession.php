<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function checkSession()
{
    if (!isset($_SESSION['loggedinuserId'])) {
        header('Location: ../user/login.php');
        var_dump(headers_list());
        exit();
    }
}

checkSession();
