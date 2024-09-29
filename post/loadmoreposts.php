<?php
require("../Navbar.php");
$db = new Database();

$category_filter = isset($_GET['filterpost']) ? mysqli_real_escape_string($db->conn, $_GET['filterpost']) : null;
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 8;
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;

$join = "user_info ON posts.author_id = user_info.id";

$where = "1=1";
$params = [];
$types = '';

if ($category_filter && $category_filter !== 'time') {
    $where .= " AND posts.category = ?";
    $params[] = $category_filter;
    $types .= 's'; // 's' for string
}

$result = $db->select('posts', "posts.*, user_info.name", $join, $where, $order, $limit);
