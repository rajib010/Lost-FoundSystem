<?php
include "../utility/Database.php";
$db = new Database();
$id = $_GET["id"];
$where = "id=$id";
$result = $db->delete("posts", $where);

if ($result) {
    header('location: ../pages/home.php');
    exit();
} else {
    echo "<script> alert('failed to delete data')</script>";
}