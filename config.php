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
define('EMAIL_PROVIDER', 'gmail'); // Options: 'gmail' or 'hostinger' - CURRENTLY SET TO GMAIL

// ========================
// GMAIL SMTP SETTINGS
// ========================
// Use these if EMAIL_PROVIDER is set to 'gmail'
// IMPORTANT: Use your Gmail App Password (not your regular Gmail password)
// - To create an App Password: Google Account → Security → 2-Step Verification → App Passwords
// - App Password can be entered with or without spaces (code will auto-remove spaces)
define('GMAIL_USER', 'uppsampa2025@gmail.com');
define('GMAIL_PASS', 'uptnytiatbhbinns'); // Gmail App Password (16 characters - spaces optional)

// ========================
// HOSTINGER SMTP SETTINGS
// ========================
// IMPORTANT: Update these with your actual Hostinger email credentials after deployment
// To get your Hostinger email:
// 1. Login to Hostinger hPanel
// 2. Go to "Emails" → "Email Accounts"
// 3. Create an email account (e.g., info@yourdomain.com or contact@yourdomain.com)
// 4. Use those credentials below:
// 
// RECOMMENDED: Create email "info@yourdomain.com" or "contact@yourdomain.com" in Hostinger
// 
// NOTE: If you haven't set up Hostinger email yet, you can temporarily use Gmail
// by changing EMAIL_PROVIDER to 'gmail' above
define('HOSTINGER_EMAIL', 'info@universalprintingpress.com'); // UPDATE THIS: Your Hostinger email address (e.g., info@yourdomain.com)
define('HOSTINGER_PASS', 'your-email-password');   // UPDATE THIS: Your Hostinger email password
define('HOSTINGER_SMTP_HOST', 'smtp.hostinger.com');
define('HOSTINGER_SMTP_PORT', 465); // Standard Hostinger SMTP port (use 465 for SSL)
define('HOSTINGER_SMTP_SECURE', 'ssl'); // Hostinger uses SSL (not TLS)

// ========================
// DEBUGGING (Set to false in production)
// ========================
define('DEBUG_MODE', false); // Set to true to see detailed error messages (only for debugging)

// ========================
// ORDER FORM SETTINGS
// ========================
define('PHONE_NUMBER', '+233599997279');
define('WHATSAPP_NUMBER', '233599997279');
// Upload directory path - works on Hostinger (use __DIR__ for root-level, or relative path)
// For Hostinger: If files are in public_html, this will work correctly
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

