<?php

require_once '../../utility/Database.php';

$db = new Database();

$sql1 = $db->select('posts', 'COUNT(*) as totalPosts');
$postsCount = $sql1->fetch_assoc()['totalPosts'];

$sql2 = $db->select('user_info', 'COUNT(*) as totalUsers');
$usersCount = $sql2->fetch_assoc()['totalUsers'];

$sql3 = $db->select('reviews', 'COUNT(*) as totalReviews');
$reviewsCount = $sql3->fetch_assoc()['totalReviews'];

$sql4 = $db->select('messages', 'COUNT(*) as totalMessages');
$messagesCount = $sql4->fetch_assoc()['totalMessages'];

$sql5 = $db->select('posts', 'category', null, null, 'COUNT(*) DESC', 1, 'category');
$topCategory = $sql5->fetch_assoc()['category'];

$sql6 = $db->select('user_info', 'name', null, null, 'COUNT(*) DESC', 1, 'name');
$topFinder = $sql6->fetch_assoc()['name'];

$sql6 = $db->select('posts', 'COUNT(*) AS blockedPost', null, 'status=0');
$blockedPost = $sql6->fetch_assoc()['blockedPost'];

$sql7 = $db->select('user_info', 'COUNT(*) AS suspendedUsers', null, "status= 'deactivated'");
$suspendedUsers = $sql7->fetch_assoc()['suspendedUsers'];


if ($postsCount && $usersCount && $reviewsCount && $messagesCount) {
    echo json_encode(['status' => 'success', 'postsCount' => $postsCount ?? 0, 'usersCount' => $usersCount ?? 0, 'reviewsCount' => $reviewsCount ?? 0, 'messagesCount' => $messagesCount ?? 0, 'topCategory' => ucfirst($topCategory) ?? 'Documents', 'topFinder' => ucfirst($topFinder) ?? 'admin', 'blockedPost' => $blockedPost ?? 0, 'suspendedUsers' => $suspendedUsers ?? 0]);
} else {
    echo json_encode(['status' => 'failed', 'message' => 'failed to get items']);
}
