<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: zerotech-access.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['video_title']);
    $url = trim($_POST['video_url']);
    $video_id = "";

    // YouTube Video ID එක වෙන් කරගන්නා වෘත්තීය Regex එක
    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
    
    if (isset($match[1])) {
        $video_id = $match[1];
    } else {
        // ලින්ක් එක වැරදි නම්
        header("Location: manage-videos.php?status=invalid_url");
        exit();
    }

    if (!empty($title) && !empty($video_id)) {
        $stmt = $conn->prepare("INSERT INTO videos (video_title, video_url) VALUES (?, ?)");
        $stmt->bind_param("ss", $title, $video_id);
        
        if ($stmt->execute()) {
            header("Location: manage-videos.php?status=success");
        } else {
            header("Location: manage-videos.php?status=error");
        }
    }
}
?>