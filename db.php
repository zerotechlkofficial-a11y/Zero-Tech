<?php
// InfinityFree එකෙන් ලබාදෙන දත්ත මෙතනට ඇතුළත් කරන්න
$host = "sql306.infinityfree.com"; // උදා: sql205.epizy.com
$dbname = "if0_41513141_zerotech";   // ඔබේ database නම
$username = "if0_41513141";             // ඔබේ database username එක
$password = "DB9FNBMa9fCUH";        // ඔබේ control panel password එක

// සම්බන්ධතාවය ගොඩනැගීම
$conn = new mysqli($host, $username, $password, $dbname);

// සම්බන්ධතාවය පරීක්ෂා කිරීම
if ($conn->connect_error) {
    die("සම්බන්ධතාවය අසාර්ථකයි: " . $conn->connect_error);
}

// සිංහල අකුරු නිවැරදිව පෙන්වීමට (UTF-8)
// db.php එකේ අන්තිමට මේක තියෙන්නම ඕනේ
$conn->set_charset("utf8mb4");
?>