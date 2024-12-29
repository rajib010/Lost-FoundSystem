<?php
require_once '../../utility/Database.php';

$db = new Database();

$where = "1=1";
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 8;
$offset = ($page - 1) * $limit;
$count_result = $db->select('user_info', "COUNT(*) as total");
$total_posts = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_posts / $limit);

$result = $db->select('user_info', "*", null, $where, null, "$offset, $limit");

if ($result && $result->num_rows > 0) {
    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    echo json_encode(['status' => 'success', 'users' => $users, 'totalPages' => $total_pages]);
} else {
    echo json_encode(['status' => 'failed', 'message' => 'No Users found']);
    exit;
}
