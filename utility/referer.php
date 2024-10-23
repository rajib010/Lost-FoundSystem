<?php
function referer()
{
    if (isset($_SERVER['HTTP_REFERER'])) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    } else {

        header("Location: users.php");
        exit;
    }
}
