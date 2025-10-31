# Hostinger Deployment Guide

## ✅ Quick Deployment Checklist

### 1. **Upload All Files**
Upload these files and folders to `public_html/` on Hostinger:
- ✅ All `.html` files (index.html, about.html, service.html, portfolio.html, order.html)
- ✅ All `.css` files (styles.css)
- ✅ All `.js` files (main.js)
- ✅ All `.php` files (contact.php, upload.php, newsletter.php)
- ✅ `config.php` (IMPORTANT: Update email settings after upload)
- ✅ `PHPMailer/` folder (entire folder with all files)
- ✅ `img/` folder (all images)
- ✅ `uploads/` folder (create if doesn't exist, set permissions to 755)
- ✅ `.htaccess` file (root level)
- ✅ `favicon.png`

### 2. **Configure Email Settings** (CRITICAL)
After uploading, edit `config.php` and update:

```php
// Set provider to Hostinger
define('EMAIL_PROVIDER', 'hostinger');

// Update these with your actual Hostinger email:
define('HOSTINGER_EMAIL', 'info@yourdomain.com'); // CHANGE THIS
define('HOSTINGER_PASS', 'your-email-password');   // CHANGE THIS
```

**To get your Hostinger email:**
1. Login to Hostinger hPanel
2. Go to "Emails" → "Email Accounts"
3. Create email account (e.g., `info@yourdomain.com`)
4. Use those credentials in `config.php`

### 3. **Set File Permissions**
- `uploads/` folder: **755** permissions (writeable by PHP)
- `config.php`: **644** permissions (readable, not writable)

### 4. **Test After Deployment**
1. Test contact form submission
2. Test order form submission
3. Test newsletter subscription
4. Check that uploaded files are stored correctly

### 5. **Enable HTTPS** (Recommended)
After SSL is installed, uncomment in `.htaccess`:
```
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

## 📁 Directory Structure on Hostinger

```
public_html/
├── index.html
├── about.html
├── service.html
├── portfolio.html
├── order.html
├── styles.css
├── main.js
├── config.php          ← Update email settings here
├── contact.php
├── upload.php
├── newsletter.php
├── .htaccess
├── favicon.png
├── PHPMailer/
│   └── src/
│       ├── Exception.php
│       ├── PHPMailer.php
│       └── SMTP.php
├── img/
│   └── (all images)
└── uploads/            ← Must be writable (755 permissions)
    └── .htaccess
```

## ⚠️ Important Notes

1. **config.php contains sensitive data** - Don't share it publicly
2. **uploads/ folder** must exist and be writable
3. **PHPMailer** must be in the same directory as PHP files
4. **Email credentials** must be set correctly or emails won't send
5. Test all forms after deployment to ensure they work

## 🔧 Troubleshooting

### Forms Not Working?
- Check that PHP files are uploaded correctly
- Verify `config.php` has correct email credentials
- Check Hostinger email account is created
- Check file permissions (uploads folder must be 755)

### Uploads Not Working?
- Ensure `uploads/` folder exists
- Check folder permissions (must be 755 or 777)
- Verify `.htaccess` in uploads folder is correct

### Emails Not Sending?
- Verify Hostinger email credentials in `config.php`
- Check that email account is created in Hostinger
- Test email account login manually
- Check Hostinger SMTP settings (should be port 465, SSL)

