# ✅ Gmail Configuration Complete

Your forms are now fully configured to use **Gmail SMTP** for sending emails!

## 📧 Current Configuration

- **Email Provider:** Gmail
- **Gmail Account:** uppsampa2025@gmail.com
- **Recipient Email:** uppsampa2025@gmail.com (receives form submissions)

## ✅ What's Been Set Up

1. **config.php** - Set to use Gmail as email provider
2. **contact.php** - Configured for Gmail SMTP
3. **upload.php** - Configured for Gmail SMTP (Order Form)
4. **Automatic password handling** - App password spaces are automatically removed

## 🔧 Gmail App Password

The code automatically handles Gmail app passwords whether they have spaces or not. Your current password is configured without spaces, which is correct.

**If you need to update your Gmail app password:**
1. Go to your Google Account settings
2. Security → 2-Step Verification → App Passwords
3. Generate a new app password for "Mail"
4. Update `GMAIL_PASS` in `config.php`

## ✅ Ready to Test

Both forms should now work with Gmail:

1. **Contact Form** (on index.html)
   - Sends emails using Gmail SMTP
   - Recipient: uppsampa2025@gmail.com

2. **Order Form** (on order.html)
   - Sends admin notification email
   - Sends customer confirmation email
   - Both use Gmail SMTP

## 🧪 Testing Steps

1. **Test Contact Form:**
   - Go to your website's contact section
   - Fill out and submit the form
   - Check uppsampa2025@gmail.com inbox

2. **Test Order Form:**
   - Go to order.html
   - Fill out the form (with or without file upload)
   - Submit
   - Check uppsampa2025@gmail.com for admin notification
   - Check customer's email for confirmation

## 🐛 Troubleshooting

### If emails don't send:

1. **Verify Gmail App Password:**
   - Make sure you're using an App Password (not regular password)
   - App passwords are 16 characters
   - You can enter it with or without spaces in config.php

2. **Check Gmail Settings:**
   - 2-Step Verification must be enabled
   - App Password must be generated for "Mail" app

3. **Enable Debug Mode (temporary):**
   ```php
   define('DEBUG_MODE', true); // In config.php
   ```
   - This will show detailed error messages
   - Remember to set back to `false` after debugging!

4. **Common Issues:**
   - "535-5.7.8 Username and Password not accepted" → Wrong app password
   - "Connection timeout" → Check internet/server connection
   - "SMTP connect() failed" → Check firewall/port 587 is open

## 🔒 Security Notes

- ✅ Gmail app passwords are secure and can be revoked anytime
- ✅ App password is different from your regular Gmail password
- ✅ If compromised, you can regenerate a new app password
- ✅ Never share your config.php file publicly

## ✨ Features

- **Automatic space handling** - Works with or without spaces in app password
- **Better error handling** - Clear error messages if something goes wrong
- **Debug mode** - Enable for troubleshooting
- **Reliable delivery** - Gmail SMTP is highly reliable

## 📝 Quick Checklist

- [x] EMAIL_PROVIDER set to 'gmail'
- [x] GMAIL_USER configured
- [x] GMAIL_PASS configured (app password)
- [x] Contact form configured for Gmail
- [x] Order form configured for Gmail
- [ ] Forms tested and working
- [ ] Debug mode disabled (set to false)

Your forms are ready to use Gmail! 🎉

