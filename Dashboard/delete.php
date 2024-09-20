<?php
require("../utility/Database.php");
require("./utility/referer.php");

$db = new Database();
$table = $_GET['table'];
$id = $_GET['id'];


$table = htmlspecialchars($table);
$id = intval($id); 

$where = "id='$id'";
$result = $db->delete($table, $where);

if ($result) {
    echo "<script>
    alert('Record deleted successfully');
    </script>";
    referer();
} else {
    echo "<script>
    alert('Failed to delete record');
    </script>";
    referer();
}
?>
