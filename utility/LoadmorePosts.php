<?php
require_once './Database.php';
$db = new Database();

$category_filter = isset($_GET['filterpost']) ? mysqli_real_escape_string($db->conn, $_GET['filterpost']) : 'time';

$where = "posts.status = 1";
if ($category_filter && $category_filter !== 'time') {
    $where .= " AND posts.category = '$category_filter'";
}

$order = "posts.time DESC";

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 8;
$offset = ($page - 1) * $limit;

$result = $db->select('posts', "*", null, $where, $order, "$offset, $limit");

$count_result = $db->select('posts', "COUNT(*) as total", null, $where);

$total_posts = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_posts / $limit);

if ($result && $result->num_rows > 0) {
    $posts = [];
    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
    echo json_encode([
        'status' => 'success',
        'posts' => $posts,
        'total_pages' => $total_pages
    ]);
} else {
    echo json_encode(['status' => 'failed', 'message' => 'No posts found']);
}
