# ✅ Final Pre-Deployment Checklist

## 📋 Quick Checklist Before Tonight's Deployment

### Configuration Files ✅
- [x] `config.php` created with email settings
- [x] `contact.php` updated to use config.php
- [x] `upload.php` updated to use config.php
- [x] `newsletter.php` updated to work without database
- [x] `.htaccess` created for security and routing
- [x] `uploads/.htaccess` created for protection

### Email Configuration
- [ ] Open `config.php` and verify settings:
  - Currently set to use Gmail (EMAIL_PROVIDER = 'gmail')
  - Gmail credentials are already configured
  - You can switch to Hostinger email later if needed

### Files Ready for Upload
- [x] All HTML files (index.html, about.html, service.html, portfolio.html, order.html, etc.)
- [x] PHP files: contact.php, upload.php, config.php, newsletter.php
- [x] CSS: styles.css
- [x] JavaScript: main.js
- [x] Images: img/ folder
- [x] PHPMailer: PHPMailer/ folder
- [x] Uploads: uploads/ folder (with .htaccess protection)
- [x] .htaccess file for main directory

### What Works Now

#### ✅ Contact Form
- Location: Homepage (index.html)
- Handler: contact.php
- Status: Ready - uses Gmail SMTP by default
- Action: Sends email to uppsampa2025@gmail.com

#### ✅ Order Form  
- Location: order.html
- Handler: upload.php
- Status: Ready - sends 2 emails (admin + customer)
- Features: File upload, form validation, email notifications

#### ✅ Newsletter (Optional)
- Location: Currently commented out in HTML
- Handler: newsletter.php
- Status: Ready but not active (commented out in HTML)
- Works: Email notification only (no database needed)

### Deployment Steps (Tonight)

1. **Login to Hostinger hPanel**

2. **Go to File Manager → public_html/**

3. **Upload ALL files and folders:**
   ```
   ✅ All .html files
   ✅ All .php files (contact.php, upload.php, config.php, newsletter.php)
   ✅ styles.css
   ✅ main.js
   ✅ .htaccess
   ✅ favicon.png
   ✅ img/ folder (with all images)
   ✅ PHPMailer/ folder (entire folder)
   ✅ uploads/ folder (can be empty, but include .htaccess)
   ```

4. **Set Permissions:**
   - Right-click `uploads/` folder → Change Permissions → Set to **755**
   - Verify all PHP files have **644** permissions

5. **Install SSL Certificate:**
   - hPanel → Advanced → SSL → Install Free SSL (Let's Encrypt)
   - Wait 5-10 minutes for activation

6. **Test Everything:**
   - Visit your website
   - Test contact form
   - Test order form with file upload
   - Check your email inbox

### Quick Email Test

After deployment, test the contact form:
1. Go to homepage
2. Scroll to contact form
3. Fill in test data and submit
4. Check `uppsampa2025@gmail.com` inbox
5. You should receive the email within seconds

### If You Want to Use Hostinger Email Instead

1. Create email in Hostinger: **Emails** → **Email Accounts**
   - Create: `info@yourdomain.com` (or any name)
   - Set a password

2. Update `config.php` on server:
   ```php
   define('EMAIL_PROVIDER', 'hostinger');
   define('HOSTINGER_EMAIL', 'info@yourdomain.com');
   define('HOSTINGER_PASS', 'your-email-password');
   ```

3. Upload updated `config.php` to server

### Important Notes

⚠️ **Current Setup:** Forms use Gmail SMTP (already configured)
- This will work immediately after deployment
- No changes needed if Gmail works fine
- You can switch to Hostinger email anytime

⚠️ **Newsletter:** Currently disabled in HTML
- Code is ready but commented out
- Activate by uncommenting newsletter section in index.html
- No database needed - just sends email notification

⚠️ **File Uploads:** 
- Maximum file size: 20 MB per file
- Allowed types: PDF, JPG, JPEG, PNG, AI, PSD, DOC, DOCX
- Files stored in `uploads/` folder
- Files automatically attached to order emails

### Troubleshooting Quick Fixes

**Forms not working?**
- Check `config.php` is uploaded
- Verify `uploads/` permissions are 755
- Check Hostinger error logs: Advanced → Error Logs

**Email not sending?**
- Verify Gmail App Password is correct
- Check PHP error logs
- Try switching to Hostinger email

**File upload failing?**
- Check `uploads/` folder permissions (must be 755)
- Verify file size is under 20MB
- Check file extension is allowed

---

## 🎉 You're Ready to Deploy!

Everything is configured and ready. Follow the deployment steps above and test thoroughly after going live.

**Good luck with your deployment tonight! 🚀**

