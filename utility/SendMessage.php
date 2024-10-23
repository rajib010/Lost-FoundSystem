<?php
require_once './Database.php';
require_once './referer.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    if (empty($name) || empty($email) || empty($message)) {
        echo json_encode(['status' => 'error', 'message' => 'Please fill in all the fields']);
        return;
    }

    $db = new Database();
    $result = $db->insert("messages", [
        'name' => $name,
        'email' => $email,
        'message' => $message,
    ]);

    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Thank you for contacting us.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'There was a problem submitting your message.']);
    }
}
?>
