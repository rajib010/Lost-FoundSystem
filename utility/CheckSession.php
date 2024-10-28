<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function checkSession() {
    if (!isset($_SESSION['loggedinuserId'])) {
        header('Location: ../user/login.php');
        exit();
    }
}

checkSession();
