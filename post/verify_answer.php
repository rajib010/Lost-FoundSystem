<?php
require("../utility/database.php");

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['post_id']) || !isset($data['answer'])) {
    echo json_encode(["error" => "Invalid input"]);
    exit;
}

$post_id = intval($data['post_id']);
$answer = trim($data['answer']);
$db = new Database();

$select = "answer, user_info.email, user_info.phone_number";
$join = "user_info ON posts.author_id = user_info.id";
$where = "posts.id = '$post_id'";

$result = $db->select('posts',$select,$join,$where);

if ($row = $result->fetch_assoc()) {
    if (strtolower($row['answer']) === strtolower($answer)) {
        echo json_encode([
            "success" => true,
            "email" => $row['email'],
            "phone" => $row['phone_number']
        ]);
    } else {
        echo json_encode(["success" => false]);
    }
} else {
    echo json_encode(["error" => "Post not found"]);
}
