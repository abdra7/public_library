<?php
session_start();
session_destroy(); // إنهاء الجلسة
header("Location: index.php"); // إعادة التوجيه للصفحة الرئيسية
exit();
?>
