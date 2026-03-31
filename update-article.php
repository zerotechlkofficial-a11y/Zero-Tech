<?php
session_start();
require_once 'db.php';
$conn->set_charset("utf8mb4");

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: zerotech-access.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $content = trim($_POST['content']);
    
    // මුලින්ම පරණ පින්තූරයේ නම ලබා ගැනීම (වෙනස් නොකළහොත් භාවිතා කිරීමට)
    $stmt_old = $conn->prepare("SELECT image_url FROM articles WHERE id = ?");
    $stmt_old->bind_param("i", $id);
    $stmt_old->execute();
    $res_old = $stmt_old->get_result();
    $old_data = $res_old->fetch_assoc();
    $image_name = $old_data['image_url'];

    // අලුත් පින්තූරයක් අප්ලෝඩ් කර ඇත්දැයි බැලීම
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $target_dir = "uploads/";
        $file_ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $new_file_name = uniqid('ZT_', true) . "." . $file_ext;
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $new_file_name)) {
            // පරණ පින්තූරය සර්වර් එකෙන් මකා දැමීම (Storage ඉතිරි කර ගැනීමට)
            if (!empty($image_name) && file_exists($target_dir . $image_name)) {
                unlink($target_dir . $image_name);
            }
            $image_name = $new_file_name;
        }
    }

    // SQL UPDATE Query
    $sql = "UPDATE articles SET title = ?, category = ?, image_url = ?, content = ? WHERE id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssi", $title, $category, $image_name, $content, $id);
        
        if ($stmt->execute()) {
            header("Location: manage-articles.php?status=updated");
        } else {
            header("Location: manage-articles.php?status=error");
        }
        $stmt->close();
    }
}
$conn->close();
?>