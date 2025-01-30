<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); 
    $stmt = $conn->prepare("UPDATE contacts SET status = 'Completed' WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: dashboard.php"); // توجيه المشرف إلى الصفحة الرئيسية بعد التحديث
        exit();
    } else {
        echo "Error updating status: " . $conn->error;
    }
}
?>