<?php
session_start();

function CheckSession(){
    if (!isset($_SESSION['loggedinuserId'])) {
        header('Location: ../../user/login.php');
        exit(); 
    }
}

CheckSession(); 
