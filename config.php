<?php
/**
 * Universal Printing Press - Email Configuration
 * 
 * Configure your email settings here for easy switching between Gmail and Hostinger SMTP
 * 
 * IMPORTANT: Before deploying, update these settings with your actual credentials!
 */

// ========================
// COMPANY INFORMATION
// ========================
define('COMPANY_NAME', 'Universal Printing Press');
define('RECIPIENT_EMAIL', 'uppsampa2025@gmail.com'); // Email address that receives form submissions

// ========================
// EMAIL PROVIDER SETTINGS
// ========================
// Set to 'hostinger' to use Hostinger SMTP, or 'gmail' to use Gmail SMTP
define('EMAIL_PROVIDER', 'gmail'); // Options: 'gmail' or 'hostinger'

// ========================
// GMAIL SMTP SETTINGS
// ========================
// Use these if EMAIL_PROVIDER is set to 'gmail'
define('GMAIL_USER', 'uppsampa2025@gmail.com');
define('GMAIL_PASS', 'uptn ytia tbhb inns'); // Gmail App Password (16 characters)

// ========================
// HOSTINGER SMTP SETTINGS
// ========================
// Use these if EMAIL_PROVIDER is set to 'hostinger'
// To get your Hostinger email:
// 1. Login to Hostinger hPanel
// 2. Go to "Emails" → "Email Accounts"
// 3. Create an email account (e.g., info@yourdomain.com)
// 4. Use those credentials below:
define('HOSTINGER_EMAIL', 'info@yourdomain.com'); // Your Hostinger email address
define('HOSTINGER_PASS', 'your-email-password');   // Your Hostinger email password
define('HOSTINGER_SMTP_HOST', 'smtp.hostinger.com');
define('HOSTINGER_SMTP_PORT', 465); // Use 465 for SSL or 587 for TLS
define('HOSTINGER_SMTP_SECURE', 'ssl'); // Options: 'ssl' or 'tls'

// ========================
// ORDER FORM SETTINGS
// ========================
define('PHONE_NUMBER', '+233599997279');
define('WHATSAPP_NUMBER', '233599997279');
define('UPLOAD_DIR', __DIR__ . '/uploads/');
define('MAX_FILE_SIZE', 20 * 1024 * 1024); // 20 MB max per file
define('ALLOWED_EXTENSIONS', ['pdf', 'jpg', 'jpeg', 'png', 'ai', 'psd', 'doc', 'docx']);

// ========================
// TIMEZONE
// ========================
date_default_timezone_set('Africa/Accra');

// ========================
// DATABASE (Optional - for newsletter)
// ========================
// Uncomment and configure if you want to store newsletter subscriptions in database
/*
define('DB_HOST', 'localhost'); // Hostinger MySQL host (usually 'localhost')
define('DB_USER', 'your_db_user'); // Your database username
define('DB_PASS', 'your_db_password'); // Your database password
define('DB_NAME', 'your_database_name'); // Your database name
*/

