# 🚀 Hostinger Deployment Checklist - Tonight's Deployment

## ✅ Pre-Deployment Preparation

### 1. Configuration Setup
- [ ] Open `config.php` and update email settings:
  - If using Hostinger email: Change `EMAIL_PROVIDER` to `'hostinger'`
  - Update `HOSTINGER_EMAIL` with your Hostinger email (e.g., `info@yourdomain.com`)
  - Update `HOSTINGER_PASS` with your Hostinger email password
  - Update `RECIPIENT_EMAIL` to the email address that should receive form submissions
- [ ] Verify Gmail settings are correct (currently set as default/fallback)
- [ ] Test email configuration locally if possible

### 2. File Permissions
- [ ] Ensure `uploads/` directory exists
- [ ] Set `uploads/` directory permissions to **755** (readable and writable by web server)
  - On Hostinger: Use File Manager → Right-click `uploads/` → Change Permissions → Set to 755
- [ ] Ensure all PHP files have permissions **644**

### 3. File Organization
- [ ] Verify all files are ready:
  - HTML files (index.html, about.html, service.html, portfolio.html, order.html, etc.)
  - PHP files (contact.php, upload.php, config.php)
  - CSS file (styles.css)
  - JavaScript file (main.js)
  - Images folder (img/)
  - PHPMailer folder (PHPMailer/)
  - Uploads folder (uploads/)
  - .htaccess file

## 📤 Deployment Steps (Hostinger hPanel)

### Step 1: Access File Manager
1. [ ] Login to Hostinger hPanel
2. [ ] Navigate to **File Manager**
3. [ ] Go to **public_html/** directory (this is your website root)

### Step 2: Upload Files
1. [ ] Upload ALL files and folders to `public_html/`:
   - All HTML files
   - All PHP files (contact.php, upload.php, config.php)
   - styles.css
   - main.js
   - .htaccess file
   - favicon.png
   - img/ folder (with all images)
   - PHPMailer/ folder (with all PHPMailer files)
   - uploads/ folder (can be empty initially)

### Step 3: Set File Permissions
1. [ ] Right-click `uploads/` folder → **Change Permissions**
2. [ ] Set permissions to **755** (Owner: Read+Write+Execute, Group: Read+Execute, Public: Read+Execute)
3. [ ] Click **Change**
4. [ ] Verify `config.php` has permissions **644**

### Step 4: Configure Email (If Using Hostinger Email)
1. [ ] In Hostinger hPanel, go to **Emails** → **Email Accounts**
2. [ ] Create email account (e.g., `info@yourdomain.com`)
3. [ ] Note the password you set
4. [ ] Update `config.php` on the server with Hostinger email credentials
5. [ ] Change `EMAIL_PROVIDER` to `'hostinger'` in `config.php`

### Step 5: Install SSL Certificate
1. [ ] In Hostinger hPanel, go to **Advanced** → **SSL**
2. [ ] Click **Install SSL** or **Get Free SSL**
3. [ ] Select **Let's Encrypt** (free SSL)
4. [ ] Install for your domain
5. [ ] Wait for SSL to activate (usually 5-10 minutes)
6. [ ] After SSL is active, uncomment HTTPS redirect in `.htaccess`:
   ```
   # Remove the # from these lines in .htaccess:
   RewriteCond %{HTTPS} off
   RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
   ```

## 🧪 Testing Checklist

### Test 1: Website Accessibility
- [ ] Visit your domain in browser
- [ ] Verify homepage loads correctly
- [ ] Check all pages load (About, Services, Portfolio, Order)
- [ ] Verify images display correctly
- [ ] Check responsive design on mobile

### Test 2: Contact Form
- [ ] Go to homepage and scroll to contact form
- [ ] Fill out contact form with test data:
  - Name: Test User
  - Email: your-email@example.com
  - Message: This is a test message
- [ ] Submit form
- [ ] Verify success message appears
- [ ] Check your email inbox for the form submission
- [ ] Verify email received correctly

### Test 3: Order Form
- [ ] Go to `order.html` page
- [ ] Fill out order form with test data
- [ ] Upload a test file (image or PDF)
- [ ] Submit form
- [ ] Verify redirect to `thank-you.html` page
- [ ] Check your email for:
  - Admin notification email (with order details)
  - Customer confirmation email
- [ ] Verify uploaded file appears in email attachment
- [ ] Check `uploads/` folder on server for uploaded file

### Test 4: File Upload
- [ ] Try uploading different file types:
  - [ ] PDF file
  - [ ] Image (JPG, PNG)
  - [ ] Verify file appears in `uploads/` folder
  - [ ] Try uploading file larger than 20MB (should be rejected)

### Test 5: Error Handling
- [ ] Try submitting contact form with missing fields (should show error)
- [ ] Try submitting order form with missing required fields (should show error)
- [ ] Verify error.html page loads if something goes wrong

## 🔧 Troubleshooting

### Issue: Forms not submitting
- Check `config.php` has correct email credentials
- Verify `EMAIL_PROVIDER` is set correctly ('gmail' or 'hostinger')
- Check PHP error logs in Hostinger hPanel → **Advanced** → **Error Logs**
- Verify `uploads/` folder permissions are 755

### Issue: Email not sending
- Verify SMTP credentials in `config.php`
- For Gmail: Ensure you're using App Password (not regular password)
- For Hostinger: Double-check email and password are correct
- Check PHP error logs for specific error messages
- Test email configuration by temporarily enabling error display

### Issue: File upload not working
- Verify `uploads/` folder exists and has 755 permissions
- Check PHP upload limits in Hostinger (should be at least 20MB)
- Verify file size is under 20MB
- Check file extension is allowed (pdf, jpg, jpeg, png, ai, psd, doc, docx)

### Issue: Website showing errors
- Check PHP version compatibility (Hostinger usually has PHP 7.4+ or 8.x)
- Verify all file paths are correct (case-sensitive on Linux servers)
- Check `.htaccess` file is not causing conflicts
- Review error logs in Hostinger hPanel

## 📝 Post-Deployment

### Immediate Actions
- [ ] Test all forms multiple times
- [ ] Test from different devices (desktop, mobile, tablet)
- [ ] Verify SSL certificate is active (https://)
- [ ] Update any hardcoded URLs if needed

### Within 24 Hours
- [ ] Monitor email inbox for form submissions
- [ ] Check `uploads/` folder for any uploaded files
- [ ] Review website analytics (if set up)
- [ ] Test all links on website
- [ ] Verify social media links work correctly

## 📧 Email Configuration Details

### Using Gmail (Default/Current)
- Provider: `'gmail'`
- SMTP Host: `smtp.gmail.com`
- Port: `587`
- Security: `STARTTLS`
- Requires: Gmail App Password (16 characters)

### Using Hostinger Email (Recommended for Production)
- Provider: `'hostinger'`
- SMTP Host: `smtp.hostinger.com`
- Port: `465` (SSL) or `587` (TLS)
- Security: `ssl` or `tls`
- Requires: Hostinger email account and password

## 🎯 Quick Reference

**Main Files to Edit:**
- `config.php` - All email and configuration settings

**Key Directories:**
- `public_html/` - Website root (upload all files here)
- `public_html/uploads/` - User uploaded files (set to 755)

**Important URLs:**
- Homepage: `https://yourdomain.com/index.html`
- Contact Form: `https://yourdomain.com/index.html#contact`
- Order Form: `https://yourdomain.com/order.html`

---

## ✅ Final Checklist Before Going Live

- [ ] All files uploaded to `public_html/`
- [ ] `uploads/` folder permissions set to 755
- [ ] `config.php` configured with correct email settings
- [ ] SSL certificate installed and active
- [ ] Contact form tested and working
- [ ] Order form tested and working
- [ ] File upload tested and working
- [ ] All pages load correctly
- [ ] Mobile responsiveness verified
- [ ] Email notifications received successfully

**🎉 Ready to Go Live!**

Good luck with your deployment tonight! If you encounter any issues, refer to the troubleshooting section above or check Hostinger's support documentation.

