<?php
require_once './Database.php';
$db = new Database();

$category_filter = isset($_GET['filterpost']) ? mysqli_real_escape_string($db->conn, $_GET['filterpost']) : null;
$join = "user_info ON posts.author_id = user_info.id";

$where = "1=1";
if ($category_filter && $category_filter !== 'time') {
    $where .= " AND posts.category = '$category_filter'";
}

$order = "posts.time DESC";

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 12;
$result = $db->select('posts', "posts.*, user_info.name", $join, $where, $order, $limit);

if ($result && $result->num_rows > 0) {
    $posts = [];
    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
    echo json_encode(['status' => 'success', 'posts' => $posts]);
} else {
    echo json_encode(['status' => 'failed', 'message' => 'No posts found']);
}