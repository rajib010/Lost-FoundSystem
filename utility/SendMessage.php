<?php
session_start(); 
require_once './Database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['loggedinuserId'])) {
        echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
        exit;
    }

    $user_id = $_SESSION['loggedinuserId'];

    $data = json_decode(file_get_contents("php://input"), true);
    
    if (!isset($data['message']) || empty(trim($data['message']))) {
        echo json_encode(['status' => 'error', 'message' => 'Message cannot be empty']);
        exit;
    }

    $message = trim($data['message']);

    $db = new Database();
    $result = $db->insert("messages", [
        'user_id'=> $user_id,
        'message' => $message,
    ]);

    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Thank you for contacting us.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'There was a problem submitting your message.']);
    }
}
?>
