<?php
require_once '../../utility/Database.php';

$db = new Database();
$where = "1=1";
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 8;
$offset = ($page - 1) * $limit;
$join = "user_info on user_info.id = posts.author_id";
$where ='1=1';
$orderBy="time DESC";
$result = $db->select('posts', "*, posts.status as pstatus, posts.id as pid", $join, $where, $orderBy, "$offset, $limit");

if ($result && $result->num_rows > 0) {
    $posts = [];
    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
    echo json_encode(['status' => 'success', 'posts' => $posts]);
} else {
    echo json_encode(['status' => 'failed', 'message' => 'No posts found']);
    exit;
}
