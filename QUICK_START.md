# 🚀 Quick Start Guide - Tonight's Deployment

## ⚡ Quick Steps (15 minutes)

### 1. Update Config (2 minutes)
Open `config.php` and verify these settings:
```php
// Current setting (works with Gmail):
EMAIL_PROVIDER = 'gmail';  // Keep this if Gmail works fine

// OR switch to Hostinger email:
EMAIL_PROVIDER = 'hostinger';  // Change if using Hostinger email
HOSTINGER_EMAIL = 'info@yourdomain.com';  // Your Hostinger email
HOSTINGER_PASS = 'your-password';  // Your Hostinger email password
```

**Recommendation:** Start with Gmail (already configured). You can switch to Hostinger email later if needed.

### 2. Upload Files (5 minutes)
1. Login to Hostinger hPanel
2. Go to **File Manager** → **public_html/**
3. Upload ALL files and folders:
   - All HTML files
   - All PHP files (contact.php, upload.php, config.php)
   - styles.css, main.js
   - .htaccess
   - img/ folder
   - PHPMailer/ folder
   - uploads/ folder (can be empty)

### 3. Set Permissions (2 minutes)
1. In File Manager, right-click `uploads/` folder
2. Click **Change Permissions**
3. Set to **755** and click **Change**

### 4. Install SSL (5 minutes)
1. In hPanel: **Advanced** → **SSL**
2. Click **Install SSL** → Select **Free SSL (Let's Encrypt)**
3. Install and wait 5 minutes

### 5. Test Forms (5 minutes)
1. Visit your website
2. Test contact form on homepage
3. Test order form at `/order.html`
4. Check your email inbox

## ✅ Done! Your website is live!

---

## 🆘 Need Help?

**Email not sending?**
- Check `config.php` credentials
- Verify `uploads/` permissions are 755
- Check Hostinger error logs: **Advanced** → **Error Logs**

**Forms not working?**
- Make sure all PHP files are uploaded
- Check file permissions
- Verify `.htaccess` file is uploaded

**SSL not working?**
- Wait 10-15 minutes after installation
- Clear browser cache
- Try accessing `https://yourdomain.com`

---

## 📧 Email Options

### Option 1: Keep Using Gmail (Easiest)
- Already configured in `config.php`
- Just upload files and test
- Works immediately

### Option 2: Use Hostinger Email (Professional)
1. Create email in Hostinger: **Emails** → **Email Accounts**
2. Create `info@yourdomain.com`
3. Update `config.php`:
   - Set `EMAIL_PROVIDER = 'hostinger'`
   - Set `HOSTINGER_EMAIL = 'info@yourdomain.com'`
   - Set `HOSTINGER_PASS = 'your-password'`
4. Upload updated `config.php`

---

**Good luck with your deployment! 🎉**

