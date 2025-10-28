<?php
/**
 * Universal Printing Press — Order Handler (PHPMailer version)
 * Gmail SMTP (PHPMailer) for reliable sending locally & on hosting
 */

declare(strict_types=1);

// =======================
// CONFIGURATION
// =======================
$companyName     = "Universal Printing Press";
$recipientEmail  = "uppsampa2025@gmail.com"; // Admin email (receiver)
$phoneNumber     = "+233599997279";
$whatsAppNumber  = "233599997279";
$uploadDir       = __DIR__ . '/uploads/';
$maxFileSize     = 20 * 1024 * 1024; // 20 MB max per file
$allowedExts     = ['pdf','jpg','jpeg','png','ai','psd','doc','docx'];

date_default_timezone_set('Africa/Accra');

// Gmail SMTP credentials (App Password recommended)
$gmailUser = "uppsampa2025@gmail.com";
$gmailPass = "uptn ytia tbhb inns"; // App password

// =======================
// PHPMailer bootstrap
// =======================
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

// =======================
// Helpers
// =======================
function clean(string $v): string {
    return htmlspecialchars(trim($v), ENT_QUOTES, 'UTF-8');
}

function userIP(): string {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) return $_SERVER['HTTP_CLIENT_IP'];
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) return explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
    return $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
}

function baseUrl(): string {
    $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (($_SERVER['SERVER_PORT'] ?? null) == 443);
    $scheme  = $isHttps ? 'https' : 'http';
    $host    = $_SERVER['HTTP_HOST'] ?? 'localhost';
    return $scheme . '://' . $host;
}

function inlineLogoBase64(string $path): string {
    if (!file_exists($path)) return '';
    $ext  = strtolower(pathinfo($path, PATHINFO_EXTENSION));
    $mime = 'image/png';
    if (in_array($ext, ['jpg','jpeg'])) $mime = 'image/jpeg';
    if ($ext === 'gif') $mime = 'image/gif';
    $data = base64_encode(file_get_contents($path));
    return "data:$mime;base64,$data";
}

function ipToLocation(string $ip): string {
    $ctx = stream_context_create(['http' => ['timeout' => 3]]);
    $json = @file_get_contents("http://ip-api.com/json/{$ip}?fields=status,country,regionName,city", false, $ctx);
    if (!$json) return 'Unknown';
    $arr = json_decode($json, true);
    if (!is_array($arr) || ($arr['status'] ?? '') !== 'success') return 'Unknown';
    $parts = array_filter([$arr['city'] ?? '', $arr['regionName'] ?? '', $arr['country'] ?? '']);
    return $parts ? implode(', ', $parts) : 'Unknown';
}

// =======================
// Validate request
// =======================
if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    http_response_code(405);
    exit('Invalid request.');
}

if (!is_dir($uploadDir)) {
    @mkdir($uploadDir, 0755, true);
}

// =======================
// Collect form fields
// =======================
$name        = clean($_POST['name']        ?? '');
$company     = clean($_POST['company']     ?? '');
$email       = clean($_POST['email']       ?? '');
$phone       = clean($_POST['phone']       ?? '');
$service     = clean($_POST['service']     ?? '');
$quantity    = clean($_POST['quantity']    ?? '');
$description = clean($_POST['description'] ?? '');
$deadline    = clean($_POST['deadline']    ?? '');
$notes       = clean($_POST['notes']       ?? '');

if (!$name || !$email || !$phone || !$service || !$quantity || !$description) {
    http_response_code(422);
    exit('Missing required fields.');
}

// =======================
// Upload handling
// =======================
$baseURL      = baseUrl();
$uploadedPaths = [];
$fileLinksHTML = '';

if (!empty($_FILES['files']['name'][0])) {
    foreach ($_FILES['files']['name'] as $idx => $origName) {
        $error = $_FILES['files']['error'][$idx] ?? UPLOAD_ERR_NO_FILE;
        if ($error !== UPLOAD_ERR_OK) continue;

        $tmpName = $_FILES['files']['tmp_name'][$idx];
        $size    = (int)($_FILES['files']['size'][$idx] ?? 0);
        $ext     = strtolower(pathinfo($origName, PATHINFO_EXTENSION));

        if ($size <= 0 || $size > $maxFileSize) continue;
        if (!in_array($ext, $allowedExts, true)) continue;

        $safeBase = preg_replace('/[^A-Za-z0-9._-]/', '_', pathinfo($origName, PATHINFO_FILENAME));
        $unique   = $safeBase . '_' . time() . '_' . bin2hex(random_bytes(3)) . '.' . $ext;
        $target   = $uploadDir . $unique;

        if (move_uploaded_file($tmpName, $target)) {
            $uploadedPaths[] = $target;
            $fileLinksHTML  .= '<li><a href="' . $baseURL . '/uploads/' . $unique . '" target="_blank" rel="noopener">'
                . htmlspecialchars($origName, ENT_QUOTES, 'UTF-8') . '</a></li>';
        }
    }
}

// =======================
// Context (IP / time / logo)
// =======================
$ipAddress      = userIP();
$submissionTime = date('Y-m-d H:i:s');
$locationText   = ipToLocation($ipAddress);
$logoDataUri    = inlineLogoBase64(__DIR__ . '/img/upplogo.png');

// =======================
// Email content (admin)
// =======================
$adminSubject = "New Order from {$name}";
$adminHTML  = '<html><body style="font-family:Arial,Helvetica,sans-serif;color:#222;">';
$adminHTML .= '<h2>New Order Details</h2>';
$adminHTML .= '<p><strong>Name:</strong> '        . $name        . '</p>';
$adminHTML .= '<p><strong>Company:</strong> '     . $company     . '</p>';
$adminHTML .= '<p><strong>Email:</strong> '       . $email       . '</p>';
$adminHTML .= '<p><strong>Phone:</strong> '       . $phone       . '</p>';
$adminHTML .= '<p><strong>Service:</strong> '     . $service     . '</p>';
$adminHTML .= '<p><strong>Quantity:</strong> '    . $quantity    . '</p>';
$adminHTML .= '<p><strong>Description:</strong><br>' . nl2br($description) . '</p>';
if ($deadline) $adminHTML .= '<p><strong>Deadline:</strong> ' . $deadline . '</p>';
if ($notes)    $adminHTML .= '<p><strong>Notes:</strong><br>' . nl2br($notes) . '</p>';
$adminHTML .= '<hr style="border:none;border-top:1px solid #ddd;margin:14px 0;" />';
$adminHTML .= '<p><strong>Submitted At:</strong> ' . $submissionTime . '</p>';
$adminHTML .= '<p><strong>IP Address:</strong> '   . $ipAddress      . '</p>';
$adminHTML .= '<p><strong>Location:</strong> '     . $locationText   . '</p>';
if ($fileLinksHTML) {
    $adminHTML .= '<p><strong>Uploaded Files:</strong></p><ul style="margin-top:6px;">' . $fileLinksHTML . '</ul>';
} else {
    $adminHTML .= '<p><strong>Uploaded Files:</strong> None</p>';
}
$adminHTML .= '</body></html>';

// =======================
// Email content (customer)
// =======================
$customerSubject = "Order Confirmation - {$companyName}";
$customerHTML = '
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body{font-family:Arial,Helvetica,sans-serif;background:#f9f9f9;margin:0;padding:20px}
.container{max-width:600px;margin:auto;background:#fff;border-radius:8px;overflow:hidden;border:1px solid #ddd}
.header{background:#044d00;padding:20px;text-align:center}
.header img{max-height:60px}
.header h2{color:#fff;margin:10px 0}
.content{padding:20px;font-size:15px;color:#333}
.content table{width:100%;border-collapse:collapse;margin-top:15px;font-size:14px}
.content table td{padding:8px;border-bottom:1px solid #eee;vertical-align:top}
.btn{display:inline-block;background:#a8e6a3;color:#044d00;padding:12px 25px;text-decoration:none;border-radius:25px;font-weight:bold;margin-top:20px}
.footer{background:#f0f0f0;text-align:center;padding:15px;font-size:12px;color:#666}
.footer a{margin:0 5px;text-decoration:none;padding:8px 12px;border-radius:5px;font-size:13px;display:inline-block}
.call{background:#044d00;color:#fff}
.whatsapp{background:#25D366;color:#fff}
.email{background:#0073e6;color:#fff}
@media only screen and (max-width:600px){
 .content table td{display:block;width:100%}
 .btn{display:block;width:100%;text-align:center}
 .footer a{display:block;margin:5px auto;width:80%}
}
</style>
</head>
<body>
  <div class="container">
    <div class="header">';

if ($logoDataUri) {
    $customerHTML .= '<img src="' . $logoDataUri . '" alt="' . htmlspecialchars($companyName, ENT_QUOTES, 'UTF-8') . ' Logo">';
}

$customerHTML .= '
      <h2>Thank You for Your Order!</h2>
    </div>
    <div class="content">
      <p>Dear <strong>' . $name . '</strong>,</p>
      <p>Thank you for placing your order with <strong>' . $companyName . '</strong>. Below is your order summary:</p>
      <table>
        <tr><td><strong>Service:</strong></td><td>' . $service . '</td></tr>
        <tr><td><strong>Quantity:</strong></td><td>' . $quantity . '</td></tr>
        <tr><td><strong>Description:</strong></td><td>' . nl2br($description) . '</td></tr>';

if ($deadline) {
    $customerHTML .= '<tr><td><strong>Preferred Deadline:</strong></td><td>' . $deadline . '</td></tr>';
}
if ($notes) {
    $customerHTML .= '<tr><td><strong>Additional Notes:</strong></td><td>' . nl2br($notes) . '</td></tr>';
}

$customerHTML .= '
      </table>
      <p>Our team will review your request and get back to you within <strong>24 hours</strong> with pricing and timeline details.</p>
      <div style="text-align:center;">
        <a href="' . $baseURL . '" class="btn">Visit Our Website</a>
      </div>
      <p style="color:#666;">We appreciate your business!</p>
      <p style="color:#666;">Best regards,<br>' . $companyName . '</p>
    </div>
    <div class="footer">
      <p>Quick Contact:</p>
      <a href="tel:' . $whatsAppNumber . '" class="call">📞 Call Us</a>
      <a href="https://wa.me/' . $whatsAppNumber . '" class="whatsapp">💬 WhatsApp</a>
      <a href="mailto:' . $recipientEmail . '" class="email">📧 Email</a>
      <p style="margin-top:10px;">' . $companyName . ' | Awurade Na Aye Storey Building, Sampa, Bono Region, Ghana</p>
    </div>
  </div>
</body>
</html>';

// =======================
// Send emails with PHPMailer
// =======================
try {
    // Admin email
    $adminMailer = new PHPMailer(true);
    $adminMailer->isSMTP();
    $adminMailer->Host       = 'smtp.gmail.com';
    $adminMailer->SMTPAuth   = true;
    $adminMailer->Username   = $gmailUser;
    $adminMailer->Password   = $gmailPass;
    $adminMailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $adminMailer->Port       = 587;

    $adminMailer->setFrom($gmailUser, $companyName);
    if ($email) $adminMailer->addReplyTo($email, $name);
    $adminMailer->addAddress($recipientEmail);
    $adminMailer->isHTML(true);
    $adminMailer->Subject = $adminSubject;
    $adminMailer->Body    = $adminHTML;

    foreach ($uploadedPaths as $fullPath) {
        if (is_file($fullPath)) {
            $adminMailer->addAttachment($fullPath, basename($fullPath));
        }
    }
    $adminMailer->send();

    // Customer email
    $custMailer = new PHPMailer(true);
    $custMailer->isSMTP();
    $custMailer->Host       = 'smtp.gmail.com';
    $custMailer->SMTPAuth   = true;
    $custMailer->Username   = $gmailUser;
    $custMailer->Password   = $gmailPass;
    $custMailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $custMailer->Port       = 587;

    $custMailer->setFrom($recipientEmail, $companyName);
    $custMailer->addReplyTo($recipientEmail, $companyName);
    $custMailer->addAddress($email, $name);
    $custMailer->isHTML(true);
    $custMailer->Subject = $customerSubject;
    $custMailer->Body    = $customerHTML;
    $custMailer->send();

    header('Location: thank-you.html');
    exit;
} catch (Exception $e) {
    http_response_code(500);
    error_log('Mailer Error: ' . $e->getMessage());
    header('Location: error.html'); // optional friendly error page
    exit;
}
