<?php

require_once '../../utility/Database.php';
$db = new Database();
$where = "1=1";
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 8;
$orderBy ='time DESC';
$join = 'user_info on user_info.id=reviews.author_id';
$result = $db->select('reviews', "*", $join, $where, $orderBy, $limit);

if ($result && $result->num_rows > 0) {
    $reviews = [];
    while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }
    echo json_encode(['status' => 'success', 'reviews' => $reviews]);
} else {
    echo json_encode(['status' => 'failed', 'message' => 'failed to load reviews']);
    exit;
}
