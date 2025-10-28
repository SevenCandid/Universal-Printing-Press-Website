<?php
declare(strict_types=1);

// =======================
// CONFIGURATION
// =======================
$companyName    = "Universal Printing Press";
$recipientEmail = "uppsampa2025@gmail.com"; // Admin email
$gmailUser      = "uppsampa2025@gmail.com"; // Gmail address used to send mail
$gmailPass      = "uptn ytia tbhb inns";    // 16-character Gmail app password

// =======================
// Load PHPMailer
// =======================
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

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
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = $gmailUser;
    $mail->Password   = $gmailPass;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Set sender and recipients
    $mail->setFrom($gmailUser, $companyName);
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
