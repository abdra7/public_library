<?php
include 'config.php';
$contacts = $conn->query("SELECT * FROM contacts ORDER BY submission_date DESC");
?>
<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Library Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Contact Messages</h2>
        <table class="dashboard-table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
            <?php while($contact = $contacts->fetch_assoc()): ?>
                <tr>
    <td><?= $contact['id'] ?></td>
    <td><?= $contact['name'] ?></td>
    <td><?= $contact['email'] ?></td>
    <td><?= substr($contact['message'], 0, 50) ?>...</td>
    <td><?= date('M j, Y', strtotime($contact['submission_date'])) ?></td>
    <td>
        <span class="status-<?= $contact['status'] ?>"><?= ucfirst($contact['status']) ?></span>
        <?php if ($contact['status'] != 'Completed'): ?>
            <a href="update_status.php?id=<?= $contact['id'] ?>" class="mark-complete">Mark as Completed</a>
        <?php endif; ?>
        <a href="delete_message.php?id=<?= $contact['id'] ?>" class="delete-message" onclick="return confirm('Are you sure you want to delete this message?');">Delete</a>
    </td>
</tr>


            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
<?php include 'includes/footer.php'; ?>