<?php
include "../utility/Database.php";
require_once('../utility/CheckSession.php');
$db = new Database();
$id = $_GET["id"];
$where = "id=$id";
$result = $db->delete("reviews", $where);

if ($result) {
    header('location: ./createreview.php');
    exit();
} else {
    echo "<script> alert('failed to delete data')</script>";
}
