<?php
declare(strict_types=1);

// =======================
// Load Configuration
// =======================
require_once __DIR__ . '/config.php';

// =======================
// Load PHPMailer
// =======================
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

// =======================
// Get Configuration Values
// =======================
$companyName    = COMPANY_NAME;
$recipientEmail = RECIPIENT_EMAIL;

// =======================
// Helper to sanitize inputs
// =======================
function clean(string $v): string {
    return htmlspecialchars(trim($v), ENT_QUOTES, 'UTF-8');
}

// =======================
// Validate request
// =======================
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Invalid request.');
}

$name    = clean($_POST['name'] ?? '');
$email   = clean($_POST['email'] ?? '');
$message = clean($_POST['message'] ?? '');

if (!$name || !$email || !$message) {
    http_response_code(422);
    exit('Missing required fields.');
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(422);
    exit('Invalid email address.');
}

// =======================
// Build HTML email body
// =======================
$body = "
<html>
<head>
<meta charset='UTF-8'>
</head>
<body style='font-family:Arial,Helvetica,sans-serif; color:#333;'>
  <h2>New Contact Form Message</h2>
  <p><strong>Name:</strong> {$name}</p>
  <p><strong>Email:</strong> {$email}</p>
  <p><strong>Message:</strong><br>" . nl2br($message) . "</p>
  <hr>
  <p>Sent from {$companyName} website contact form</p>
</body>
</html>
";

// =======================
// Send email with PHPMailer
// =======================
try {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    
    // Configure SMTP based on provider
    if (EMAIL_PROVIDER === 'hostinger') {
        // Hostinger SMTP Configuration
        $mail->Host       = HOSTINGER_SMTP_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = HOSTINGER_EMAIL;
        $mail->Password   = HOSTINGER_PASS;
        $mail->SMTPSecure = HOSTINGER_SMTP_SECURE === 'ssl' ? PHPMailer::ENCRYPTION_SMTPS : PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = HOSTINGER_SMTP_PORT;
        $senderEmail      = HOSTINGER_EMAIL;
    } else {
        // Gmail SMTP Configuration (default)
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = GMAIL_USER;
        $mail->Password   = GMAIL_PASS;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $senderEmail      = GMAIL_USER;
    }

    // Set sender and recipients
    $mail->setFrom($senderEmail, $companyName);
    $mail->addReplyTo($email, $name);
    $mail->addAddress($recipientEmail);

    // Email content
    $mail->isHTML(true);
    $mail->Subject = "New Contact Message - {$companyName}";
    $mail->Body    = $body;

    $mail->send();
    echo "success";
} catch (Exception $e) {
    // Log the error instead of showing raw info to the user
    error_log('Contact form mailer error: ' . $mail->ErrorInfo);
    http_response_code(500);
    echo "Failed to send message. Please try again later.";
}
