<?php
require_once('../../utility/Database.php');

$db = new Database();
$id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($id == 0 || empty($action)) {
    echo "<script>
    alert('Invalid request');
    window.location.href = document.referrer;
    </script>";
    exit();
}

// Determine status based on action
if ($action === 'block') {
    $status = 0;
} elseif ($action === 'unblock') {
    $status = 1;
} else {
    echo "<script>
    alert('Invalid action');
    window.location.href = document.referrer;
    </script>";
    exit();
}

// Update post status
// Update post status
$result = $db->update('posts', ['status' => $status], "id = $id");

if ($result) {
    $message = ($action === 'block') ? 'Post blocked successfully' : 'Post unblocked successfully';
    echo "<script>
    alert('$message');
    window.location.href = document.referrer;
    </script>";
} else {
    echo "<script>
    alert('Action failed');
    window.location.href = document.referrer;
    </script>";
}

?>
