
<!-- index.php -->
<?php include 'includes/header.php'; 
session_start();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Public Library</title>
    <link rel="stylesheet" href="style.css">
</head>

    <main>
        
            <h1 >Upcoming Events</h1>
            <br>
        <div class="events-container">
            <article class="event-card featured">
                <div class="event-content">
                    <h2>Book Reading: Classic Novels</h2>
                    <p class="event-description">Join us for an engaging book reading session featuring timeless classic novels. Our expert readers will bring these masterpieces to life and lead discussions about their themes and impact.</p>
                </div>
                <div class="event-details">
                    <div class="event-meta">
                        <strong>Date:</strong>
                        <span>March 15, 2025</span>
                    </div>
                    <div class="event-meta">
                        <strong>Time:</strong>
                        <span>3:00 PM - 5:00 PM</span>
                    </div>
                    <div class="event-meta">
                        <strong>Location:</strong>
                        <span>Main Hall</span>
                    </div>
                </div>
            </article>

            <article class="event-card workshop">
                <div class="event-content">
                    <h2>Creative Writing Workshop</h2>
                    <p class="event-description">Enhance your writing skills with this interactive workshop led by published authors. Learn techniques for storytelling, character development, and narrative structure.</p>
                </div>
                <div class="event-details">
                    <div class="event-meta">
                        <strong>Date:</strong>
                        <span>March 22, 2025</span>
                    </div>
                    <div class="event-meta">
                        <strong>Time:</strong>
                        <span>2:00 PM - 4:00 PM</span>
                    </div>
                    <div class="event-meta">
                        <strong>Location:</strong>
                        <span>Conference Room</span>
                    </div>
                </div>
            </article>

            <article class="event-card children">
                <div class="event-content">
                    <h2>Children's Storytelling Hour</h2>
                    <p class="event-description">A fun-filled storytelling session for children, featuring beloved fairy tales and interactive activities. Perfect for young readers aged 5-10 years.</p>
                </div>
                <div class="event-details">
                    <div class="event-meta">
                        <strong>Date:</strong>
                        <span>March 29, 2025</span>
                    </div>
                    <div class="event-meta">
                        <strong>Time:</strong>
                        <span>10:00 AM - 11:30 AM</span>
                    </div>
                    <div class="event-meta">
                        <strong>Location:</strong>
                        <span>Kids' Section</span>
                    </div>
                </div>
            </article>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>