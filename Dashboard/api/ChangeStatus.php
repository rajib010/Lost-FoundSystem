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
if ($action === 'suspend') {
    $status = 'deactivated';
} elseif ($action === 'unsuspend') {
    $status = 'active';
} else {
    echo "<script>
    alert('Invalid action');
    window.location.href = document.referrer;
    </script>";
    exit();
}

// Update user status
$result = $db->update('user_info', ['status' => $status], "id = $id");

if ($result) {
    echo "<script>
    window.location.href = document.referrer;
    </script>";
} else {
    echo "<script>
    alert('Action failed');
    window.location.href = document.referrer;
    </script>";
}
?>
