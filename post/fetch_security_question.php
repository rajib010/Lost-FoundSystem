<?php
require("../utility/Database.php");
header('Content-Type: application/json');


if (!isset($_GET['post_id'])) {
    echo json_encode(["error" => "Invalid post ID"]);
    exit;
}

$post_id = intval($_GET['post_id']);
$db = new Database();
$where = "id = '$post_id'";

$result = $db->select('posts', 'question', null, $where);

if ($row = $result->fetch_assoc()) {
    echo json_encode(["question" => $row['question']]);
} else {
    echo json_encode(["error" => "No question found"]);
}
