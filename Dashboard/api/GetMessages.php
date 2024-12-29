<?php
require_once '../../utility/Database.php';

$db = new Database();
$where = "1=1";
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 8;
$offset = ($page - 1) * $limit;
$orderBy = "recievedAt DESC";
$result = $db->select('messages', "*", null, $where, $orderBy, "$offset, $limit");

if ($result && $result->num_rows > 0) {
    $messages = [];
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
    echo json_encode(['status' => 'success', 'messages' => $messages]);
} else {
    echo json_encode(['status' => 'faild', 'message' => 'failed to load messages']);
    exit;
}
