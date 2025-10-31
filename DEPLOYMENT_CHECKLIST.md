# 🚀 Hostinger Deployment Checklist

## ✅ PRE-DEPLOYMENT CHECKLIST

### 1. **Files Ready**
- [ ] All HTML files (index.html, about.html, service.html, portfolio.html, order.html)
- [ ] styles.css
- [ ] main.js
- [ ] All PHP files (contact.php, upload.php, newsletter.php)
- [ ] config.php (will update email settings after upload)
- [ ] PHPMailer folder (entire folder with all files)
- [ ] img/ folder (all images)
- [ ] uploads/ folder (create if missing, will set permissions on server)
- [ ] .htaccess file (root level)
- [ ] uploads/.htaccess file
- [ ] favicon.png

### 2. **After Upload to Hostinger**

#### A. Create Email Account
1. [ ] Login to Hostinger hPanel
2. [ ] Go to "Emails" → "Email Accounts"
3. [ ] Create email: `info@yourdomain.com` (or `contact@yourdomain.com`)
4. [ ] Save email and password

#### B. Update config.php
1. [ ] Edit `config.php` on Hostinger
2. [ ] Update `EMAIL_PROVIDER` = `'hostinger'` ✅ (Already set)
3. [ ] Update `HOSTINGER_EMAIL` = Your Hostinger email (e.g., `info@yourdomain.com`)
4. [ ] Update `HOSTINGER_PASS` = Your Hostinger email password
5. [ ] Save file

#### C. Set File Permissions
1. [ ] Set `uploads/` folder permissions to **755** (or **777** if 755 doesn't work)
   - Use File Manager in hPanel or FTP client
   - Right-click folder → Permissions → Set to 755

### 3. **Test Everything**
1. [ ] Test contact form submission
2. [ ] Test order form submission (with file upload)
3. [ ] Test newsletter subscription
4. [ ] Check that emails are received
5. [ ] Verify uploaded files are stored in `uploads/` folder
6. [ ] Test all pages load correctly

### 4. **SSL/HTTPS (Recommended)**
1. [ ] Install SSL certificate in Hostinger (usually automatic)
2. [ ] Test HTTPS works
3. [ ] Uncomment HTTPS redirect in `.htaccess` if needed

## 📝 Quick Setup After Upload

### Step 1: Update Email Settings
Edit `config.php` and change:
```php
define('HOSTINGER_EMAIL', 'info@yourdomain.com'); // Your Hostinger email
define('HOSTINGER_PASS', 'your-email-password');   // Your Hostinger email password
```

### Step 2: Set Permissions
In Hostinger File Manager:
- Right-click `uploads/` folder
- Select "Change Permissions"
- Set to **755** (or **777** if needed)

### Step 3: Test
1. Visit your website
2. Submit contact form
3. Check your email inbox
4. Test order form with file upload

## ⚠️ IMPORTANT NOTES

1. **config.php contains passwords** - Never share publicly
2. **uploads/ folder** must be writable by PHP (755 or 777)
3. **Email credentials** must be correct or forms won't send emails
4. All PHP files must be in `public_html/` folder
5. PHPMailer folder must be uploaded completely

## 🐛 Troubleshooting

### "405 Method Not Allowed"
- ✅ Already fixed in main.js - forms work correctly

### Emails Not Sending
- Check `config.php` has correct Hostinger email credentials
- Verify email account exists in Hostinger
- Test email login manually
- Check error logs in Hostinger hPanel

### Uploads Not Working
- Check `uploads/` folder permissions (755 or 777)
- Verify folder exists
- Check `.htaccess` in uploads folder is correct
