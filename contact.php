<?php
include 'config.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    if ($name && $email && $message) {
        try {
            $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $message);
            
            if ($stmt->execute()) {
                $_SESSION['contact_message'] = "Thank you for your message. We'll get back to you soon!";
                $_SESSION['contact_status'] = "success";
            } else {
                throw new Exception("Error saving message");
            }
        } catch (Exception $e) {
            $_SESSION['contact_message'] = "Sorry, there was an error sending your message. Please try again later.";
            $_SESSION['contact_status'] = "error";
            error_log($e->getMessage());
        }
    } else {
        $_SESSION['contact_message'] = "Please fill in all required fields.";
        $_SESSION['contact_status'] = "error";
    }
    
   // Correct redirection
   header("Location: contact.php");
   exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Us - Public Library</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
        <form id="contact-form" action="contact.php" method="POST">
        <h2>Contact Us</h2>
            <?php if(isset($_SESSION['contact_message'])): ?>
                <div class="alert <?= $_SESSION['contact_status'] ?>">
                    <?= $_SESSION['contact_message'] ?>
                </div>
                <?php 
                unset($_SESSION['contact_message']);
                unset($_SESSION['contact_status']);
                ?>
            <?php endif; ?>
            
            <div class="form-group">
                <input type="text" name="name" placeholder="Your Name" required
                       value="<?= isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : '' ?>">
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Your Email" required
                       value="<?= isset($_SESSION['user_email']) ? htmlspecialchars($_SESSION['user_email']) : '' ?>">
            </div>
            <div class="form-group">
                <textarea name="message" placeholder="Your Message" required></textarea>
            </div>
            <button type="submit">Send Message</button>
        </form>
</body>
</html>
<?php include 'includes/footer.php'; $conn->close(); ?>