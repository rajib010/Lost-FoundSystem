<?php
require_once '../../utility/Database.php';

$db = new Database();

$where = "1=1";
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 8;
$result = $db->select('user_info', "*", null, $where, null, $limit);

if ($result && $result->num_rows > 0) {
    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    echo json_encode(['status' => 'success', 'users' => $users]);
} else {
    echo json_encode(['status' => 'failed', 'message' => 'No Users found']);
    exit;
}
?>
