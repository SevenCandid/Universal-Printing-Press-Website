<?php
/**
 * Universal Printing Press - Newsletter Subscription Handler
 * 
 * Simple email-based newsletter subscription (no database required)
 * If you want database storage, you can set up a MySQL database later.
 */

declare(strict_types=1);

// Load Configuration
require_once __DIR__ . '/config.php';

// Load PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

// Validate request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Invalid request.');
}

$email = trim($_POST['newsletter_email'] ?? '');

if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(422);
    echo "Please enter a valid email address.";
    exit;
}

// Optional: Check if database is configured
// Uncomment the following block if you set up a MySQL database:
/*
$host = "localhost"; // Your Hostinger MySQL host (usually localhost)
$user = "your_db_user"; // Your database username
$pass = "your_db_password"; // Your database password
$db   = "your_database_name"; // Your database name

try {
    $mysqli = new mysqli($host, $user, $pass, $db);
    if (!$mysqli->connect_error) {
        // Create table if it doesn't exist
        $mysqli->query("CREATE TABLE IF NOT EXISTS newsletter_subscribers (
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) UNIQUE NOT NULL,
            subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");
        
        // Insert email
        $stmt = $mysqli->prepare("INSERT IGNORE INTO newsletter_subscribers (email) VALUES (?)");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->close();
        $mysqli->close();
    }
} catch (Exception $e) {
    // Database not available, continue with email-only approach
    error_log('Newsletter database error: ' . $e->getMessage());
}
*/

// Send notification email to admin
try {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    
    // Configure SMTP based on provider
    if (EMAIL_PROVIDER === 'hostinger') {
        $mail->Host       = HOSTINGER_SMTP_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = HOSTINGER_EMAIL;
        $mail->Password   = HOSTINGER_PASS;
        $mail->SMTPSecure = HOSTINGER_SMTP_SECURE === 'ssl' ? PHPMailer::ENCRYPTION_SMTPS : PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = HOSTINGER_SMTP_PORT;
        $senderEmail      = HOSTINGER_EMAIL;
    } else {
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = GMAIL_USER;
        $mail->Password   = GMAIL_PASS;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $senderEmail      = GMAIL_USER;
    }
    
    $mail->setFrom($senderEmail, COMPANY_NAME);
    $mail->addAddress(RECIPIENT_EMAIL);
    $mail->isHTML(true);
    $mail->Subject = "New Newsletter Subscription - " . COMPANY_NAME;
    $mail->Body    = "
        <html>
        <head><meta charset='UTF-8'></head>
        <body style='font-family:Arial,Helvetica,sans-serif;color:#333;'>
            <h2>New Newsletter Subscription</h2>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Subscribed At:</strong> " . date('Y-m-d H:i:s') . "</p>
            <hr>
            <p>This person subscribed through the website newsletter form.</p>
        </body>
        </html>
    ";
    
    $mail->send();
    echo "Thank you for subscribing!";
} catch (Exception $e) {
    error_log('Newsletter mailer error: ' . $mail->ErrorInfo);
    // Still return success to user even if email fails
    echo "Thank you for subscribing!";
}

