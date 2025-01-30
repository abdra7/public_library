<?php 
session_start(); // يجب أن يكون أول سطر في الكود
include 'config.php';
include 'includes/header.php'; 

error_reporting(E_ALL);
ini_set('display_errors', 1);

// التحقق من الاتصال بقاعدة البيانات
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

try {
    $stmt = $conn->prepare("SELECT id, title, cover_image, author, description FROM books");
    $stmt->execute();
    $books = $stmt->get_result();
} catch (Exception $e) {
    die("Database error: " . htmlspecialchars($e->getMessage()));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Public Library</title>
    <link rel="stylesheet" href="style.css">
</head>
<body> 
<main>
    <section class="hero">
        <div class="hero-content">
            <img src="images/logo.png" alt="Library Logo" class="library-logo">
            <h2>Welcome to Our Public Library</h2>
            <video controls>
                <source src="images/book.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </section>

    <section class="book-gallery">
        <h2>Books We Have</h2>
        <div class="grid-container">
            <?php if ($books->num_rows > 0): ?>
                <?php while ($book = $books->fetch_assoc()): ?>
                    <div class="book-item" data-description="<?= htmlspecialchars($book['description']) ?>">
                        <img src="<?= htmlspecialchars($book['cover_image']) ?>" 
                             alt="<?= htmlspecialchars($book['title']) ?>" 
                             class="book-cover">
                        <h3><?= htmlspecialchars($book['title']) ?></h3>
                        <p class="author"><?= htmlspecialchars($book['author']) ?></p>
                        <div class="book-description"></div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No books available.</p>
            <?php endif; ?>
        </div>
    </section>
</main>
<script src="script.js"></script>
</body>
</html>

<?php 
include 'includes/footer.php'; 
$conn->close();
?>
