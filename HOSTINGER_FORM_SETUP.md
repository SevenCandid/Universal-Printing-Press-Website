# Hostinger Form Setup Guide

## ✅ Forms Are Now Ready for Hostinger

Both the **Contact Form** and **Order Form** have been updated to work reliably on Hostinger hosting.

## 🔧 Required Setup Steps

### Step 1: Configure Email Credentials

1. **Login to Hostinger hPanel**
2. **Go to "Emails" → "Email Accounts"**
3. **Create an email account** (e.g., `info@yourdomain.com` or `contact@yourdomain.com`)
4. **Note down the email address and password**

### Step 2: Update config.php

Open `config.php` and update these lines:

```php
define('HOSTINGER_EMAIL', 'info@yourdomain.com'); // Replace with your Hostinger email
define('HOSTINGER_PASS', 'your-email-password');   // Replace with your email password
```

**Important:** Make sure `EMAIL_PROVIDER` is set to `'hostinger'`:
```php
define('EMAIL_PROVIDER', 'hostinger');
```

### Step 3: Set Uploads Folder Permissions

In Hostinger File Manager:
1. Right-click the `uploads/` folder
2. Select "Change Permissions"
3. Set to **755** (or **777** if 755 doesn't work)

### Step 4: Test the Forms

1. **Test Contact Form:**
   - Go to your website's contact section
   - Fill out and submit the form
   - Check your email inbox (the recipient email set in `RECIPIENT_EMAIL`)

2. **Test Order Form:**
   - Go to `order.html`
   - Fill out the form and upload a test file
   - Submit the form
   - Check your email inbox

## 🐛 Troubleshooting

### Forms Not Sending Emails?

1. **Check config.php:**
   - Verify `HOSTINGER_EMAIL` and `HOSTINGER_PASS` are correct
   - Make sure `EMAIL_PROVIDER` is set to `'hostinger'`
   - Ensure email account exists in Hostinger

2. **Check Email Account:**
   - Try logging into the email account manually
   - Verify the password is correct
   - Make sure the email account is active

3. **Enable Debug Mode (Temporary):**
   - In `config.php`, set `define('DEBUG_MODE', true);`
   - Submit a form and check error logs in Hostinger hPanel
   - **Remember to set it back to `false` after debugging!**

4. **Check Error Logs:**
   - In Hostinger hPanel, go to "Error Logs"
   - Look for PHP errors related to email sending
   - Common issues:
     - Wrong email/password
     - SMTP connection timeout
     - SSL certificate issues

### Uploads Not Working?

1. **Check Folder Permissions:**
   - `uploads/` folder must be **755** or **777**
   - Right-click folder → Change Permissions

2. **Check Folder Exists:**
   - Make sure `uploads/` folder exists in your `public_html/` directory
   - If missing, create it with 755 permissions

3. **Check File Size:**
   - Maximum file size is 20MB per file
   - Check PHP `upload_max_filesize` in Hostinger PHP settings

### Still Not Working?

**Temporary Solution - Use Gmail:**
If Hostinger email isn't working, you can temporarily use Gmail:

1. In `config.php`, change:
   ```php
   define('EMAIL_PROVIDER', 'gmail');
   ```

2. The Gmail credentials are already configured in `config.php`

3. **Note:** Gmail requires an "App Password" (not your regular password)

## ✨ What's Been Improved

1. **Better Error Handling:**
   - Forms now provide clear error messages
   - Validates email configuration before attempting to send
   - Better error logging for debugging

2. **Hostinger-Specific Fixes:**
   - Added SSL certificate verification options for Hostinger SMTP
   - Improved SMTP connection handling
   - Better timeout handling

3. **Enhanced User Experience:**
   - Better loading states
   - Clearer error messages
   - Improved form validation feedback

4. **Debugging Support:**
   - Debug mode for troubleshooting
   - Detailed error logging
   - Console error reporting

## 📝 Quick Checklist

- [ ] Hostinger email account created
- [ ] `config.php` updated with email credentials
- [ ] `EMAIL_PROVIDER` set to `'hostinger'`
- [ ] `uploads/` folder permissions set to 755
- [ ] Contact form tested
- [ ] Order form tested
- [ ] Emails received successfully
- [ ] Debug mode disabled (set to `false`)

## 🔒 Security Notes

- Never share your `config.php` file publicly
- Keep your email passwords secure
- Set `DEBUG_MODE` to `false` in production
- Regularly check error logs for suspicious activity

## 📞 Need Help?

If forms still don't work after following this guide:
1. Check Hostinger error logs
2. Enable debug mode temporarily
3. Contact Hostinger support if SMTP issues persist
4. Verify PHP version compatibility (PHP 7.4+ recommended)

