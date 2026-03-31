<?php
session_start();
require_once 'db.php';

if (isset($_SESSION['admin_logged_in']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM videos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}
header("Location: manage-videos.php");
exit();
?>