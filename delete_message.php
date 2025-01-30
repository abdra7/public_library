<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); 
    $stmt = $conn->prepare("DELETE FROM contacts WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: dashboard.php"); // توجيه المشرف إلى الصفحة الرئيسية بعد الحذف
        exit();
    } else {
        echo "Error deleting message: " . $conn->error;
    }
}
?>
