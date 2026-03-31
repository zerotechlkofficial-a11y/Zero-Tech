<?php
session_start();
require_once 'db.php';
$conn->set_charset("utf8mb4");

// 1. ආරක්ෂාව පරීක්ෂා කිරීම
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: zerotech-access.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $content = trim($_POST['content']);
    $image_name = "";

    // 2. පින්තූරය අප්ලෝඩ් කිරීමේ ක්‍රියාවලිය
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $target_dir = "uploads/";
        $file_name = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];
        
        // පින්තූරයේ extension එක ලබා ගැනීම (jpg, png etc.)
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        
        // පින්තූරයට අලුත් අද්විතීය නමක් ලබා දීම (Unique name)
        $new_file_name = uniqid('ZT_', true) . "." . $file_ext;
        $target_file = $target_dir . $new_file_name;

        // පින්තූරය uploads ෆෝල්ඩරයට මාරු කිරීම
        if (move_uploaded_file($file_tmp, $target_file)) {
            $image_name = $new_file_name;
        } else {
            header("Location: admin-dashboard.php?status=upload_error");
            exit();
        }
    }

    // හිස් දත්ත ඇතුළත් වීම වැළැක්වීම
    if (empty($title) || empty($content) || empty($image_name)) {
        header("Location: admin-dashboard.php?status=empty");
        exit();
    }

    // 3. SQL Prepared Statement (මෙහි image_url වෙනුවට image_name එක සේව් වේ)
    $sql = "INSERT INTO articles (title, category, image_url, content) VALUES (?, ?, ?, ?)";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssss", $title, $category, $image_name, $content);
        
        if ($stmt->execute()) {
            header("Location: admin-dashboard.php?status=success");
        } else {
            header("Location: admin-dashboard.php?status=error");
        }
        $stmt->close();
    }
}

$conn->close();
?>