<?php
session_start();
require_once 'db.php';

// 1. ආරක්ෂාව පරීක්ෂා කිරීම (ඇඩ්මින් ලොග් වී නැත්නම් මකන්න දෙන්න එපා)
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: zerotech-access.php");
    exit();
}

// 2. URL එක හරහා ID එක ලැබී ඇත්දැයි බැලීම
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // ආරක්ෂාව සඳහා ID එක අනිවාර්යයෙන්ම ඉලක්කමක් බවට පත් කිරීම

    // 3. SQL Delete Query එක සකස් කිරීම
    $sql = "DELETE FROM articles WHERE id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id); // "i" යනු Integer (ඉලක්කමක්) බවයි
        
        if ($stmt->execute()) {
            // සාර්ථකව මැකුණු පසු නැවත ලැයිස්තුවට යන්න
            header("Location: manage-articles.php?status=deleted");
        } else {
            // වැරදීමක් වුණොත්
            header("Location: manage-articles.php?status=error");
        }
        $stmt->close();
    }
} else {
    // ID එකක් නැතිව මේ පිටුවට ආවොත් කෙලින්ම ලැයිස්තුවට යවන්න
    header("Location: manage-articles.php");
}

$conn->close();
?>