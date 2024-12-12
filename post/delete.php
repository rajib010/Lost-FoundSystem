<?php
require_once("../utility/CheckSession.php");
include "../utility/Database.php";
$db = new Database();
$id = intval($_GET["id"]);
$where = "id=$id";
$result = $db->delete("posts", $where);

if ($result) {
    echo "<script>
        window.location.href='./viewposts.php';
    </script>";
} else {
    echo "<script> alert('failed to delete data')</script>";
}
