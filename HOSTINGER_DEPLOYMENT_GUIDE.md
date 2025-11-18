# 🚀 Universal Printing Press - Hostinger Deployment Guide

## 🎯 Deploy BOTH Apps on Your Existing Hostinger Premium

You already have Hostinger Premium for 48 months - let's use it! **No additional costs needed!**

---

## 📦 **What You'll Deploy**

```
Your Hostinger Account:
├── 📁 public_html/                    (Main domain)
│   ├── index.html                     (Public Website)
│   ├── about.html
│   ├── contact.php                    (Works perfectly!)
│   └── ... (all website files)
│
├── 📁 app/                            (Subdomain/Subfolder)
│   └── universal-printing-press-app/  (Management App)
│       ├── .next/
│       ├── node_modules/
│       └── ... (Next.js built files)
│
└── 🗄️ MySQL Database (if needed)
```

---

## 🎯 **STEP 1: Set Up Domain Structure**

### **Option A: Subdomain (RECOMMENDED)**

```
Main Site:    uppsampa.com               → Public Website
Management:   app.uppsampa.com           → Management App
Email:        name@uppsampa.com          → Professional email
```

### **Option B: Subfolder**

```
Main Site:    uppsampa.com               → Public Website  
Management:   uppsampa.com/app           → Management App
```

**I recommend Option A (subdomain) for cleaner separation.**

---

## 🚀 **STEP 2: Deploy Public Website**

### **This is EASY - You Already Know HTML!**

```bash
# Method 1: File Manager (Easiest)
1. Login to Hostinger hPanel
2. Go to "File Manager"
3. Navigate to public_html/
4. Upload all your website files:
   - index.html
   - about.html
   - service.html
   - portfolio.html
   - order.html
   - contact.php ✅ (Will work!)
   - upload.php ✅ (Will work!)
   - styles.css
   - main.js
   - img/ folder
   - uploads/ folder (set permissions to 755)

# Method 2: FTP (Professional)
1. Download FileZilla
2. Get FTP credentials from Hostinger
3. Connect and upload files
```

### **Configure PHP (For Contact Form)**

Your `contact.php` and `upload.php` will work immediately!

But update email settings:

```php
// In contact.php
$to = "yourname@uppsampa.com";  // Use your Hostinger email

// For SMTP (more reliable):
$mail->Host = 'smtp.hostinger.com';
$mail->SMTPAuth = true;
$mail->Username = 'yourname@uppsampa.com';
$mail->Password = 'your-email-password';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
```

**Website will be live at: `http://yourdomain.com`** ✅

---

## 🚀 **STEP 3: Deploy Management App (Next.js)**

### **3A: Enable Node.js on Hostinger**

```bash
1. Login to hPanel
2. Go to "Advanced" → "SSH Access"
3. Enable SSH access
4. Note your SSH credentials
```

### **3B: Connect via SSH**

```bash
# On Windows (use PuTTY or Windows Terminal)
ssh username@yourdomain.com -p 65002

# You'll see a terminal prompt like:
username@server:~$
```

### **3C: Upload Next.js App**

**Method 1: Git (RECOMMENDED)**

```bash
# In SSH terminal:

# 1. Navigate to your home directory
cd ~

# 2. Create app directory
mkdir app
cd app

# 3. Clone from GitHub (after you push it)
git clone https://github.com/SevenCandid/UPP-Management-App.git
cd UPP-Management-App

# 4. Install Node.js (if not already)
# Hostinger Premium includes Node.js, check version:
node --version  # Should be 18.x or higher

# 5. Install dependencies
npm install

# 6. Create .env.local file
nano .env.local

# Add:
NEXT_PUBLIC_SUPABASE_URL=https://mtyhkxufhyuctljchcwh.supabase.co
NEXT_PUBLIC_SUPABASE_ANON_KEY=eyJhbGci...

# Save: Ctrl+X, then Y, then Enter

# 7. Build the app
npm run build

# 8. Test it
npm start

# Should see: "Ready on http://localhost:3000"
```

**Method 2: FTP Upload**

```bash
# Build locally first:
cd universal-printing-press-app
npm run build

# Upload via FTP:
# - Upload entire folder to ~/app/
# - Make sure to upload node_modules/ too (or run npm install via SSH)
```

### **3D: Set Up Process Manager (Keep App Running)**

```bash
# Install PM2 (process manager)
npm install -g pm2

# Start your app with PM2
cd ~/app/UPP-Management-App
pm2 start npm --name "upp-app" -- start

# Make it auto-start on server restart
pm2 startup
pm2 save

# Check status
pm2 status

# View logs
pm2 logs upp-app
```

### **3E: Configure Subdomain**

```bash
# In Hostinger hPanel:

1. Go to "Domains" → "Subdomains"
2. Click "Create Subdomain"
3. Enter: app
4. Document root: /home/username/app/UPP-Management-App/.next
5. Click "Create"

# Or if using proxy:
Document root: /home/username/public_html/app
```

### **3F: Set Up Reverse Proxy**

Create `.htaccess` in `public_html/app/`:

```apache
RewriteEngine On
RewriteRule ^$ http://127.0.0.1:3000/ [P,L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ http://127.0.0.1:3000/$1 [P,L]
```

This makes `app.uppsampa.com` point to your Next.js app running on port 3000.

**Management app will be live at: `http://app.uppsampa.com`** ✅

---

## 🗄️ **STEP 4: Database Options**

### **Option A: Keep Using Supabase (RECOMMENDED)**

```bash
✅ Already working
✅ Free tier
✅ No migration needed
✅ Real-time features
✅ Row Level Security

Just keep using it! Nothing to change.
```

### **Option B: Migrate to Hostinger MySQL**

```bash
# Only if you want everything on Hostinger

1. Create MySQL database in hPanel
2. Export data from Supabase
3. Import to MySQL
4. Update connection strings in app

Not recommended - Supabase is better and already set up!
```

---

## 📧 **STEP 5: Set Up Professional Email**

### **You Get 100 Email Accounts! Use Them!**

```bash
# In Hostinger hPanel:

1. Go to "Emails" → "Email Accounts"
2. Create emails:
   - info@uppsampa.com (main contact)
   - orders@uppsampa.com (for orders)
   - support@uppsampa.com (for support)
   - yourname@uppsampa.com (personal)

3. Access via:
   - Webmail: webmail.uppsampa.com
   - Mobile: Use IMAP/SMTP settings
   - Desktop: Outlook, Thunderbird, etc.
```

### **Update Contact Form**

```php
// In contact.php
$to = "info@uppsampa.com";  // Your new email!

// SMTP settings:
$mail->Host = 'smtp.hostinger.com';
$mail->Username = 'info@uppsampa.com';
$mail->Password = 'your-email-password';
```

---

## 🔐 **STEP 6: Enable SSL (HTTPS)**

```bash
# In Hostinger hPanel:

1. Go to "Advanced" → "SSL"
2. Click "Install SSL"
3. Select "Free SSL" (Let's Encrypt)
4. Install for:
   ✅ yourdomain.com
   ✅ www.yourdomain.com
   ✅ app.yourdomain.com

Takes 5 minutes, then your sites are:
🔒 https://uppsampa.com
🔒 https://app.uppsampa.com
```

---

## 📊 **Final Setup Checklist**

```
✅ Public website uploaded to public_html/
✅ Management app deployed to ~/app/
✅ PM2 running and auto-starting
✅ Subdomain (app.uppsampa.com) configured
✅ SSL certificates installed
✅ Email accounts created
✅ Contact form configured with SMTP
✅ File upload permissions set (755)
✅ Test everything works

🎉 Both apps are LIVE!
```

---

## 💰 **Cost Breakdown**

```
Hostinger Premium (48 months):  Already paid! ✅
Public Website:                 $0 additional
Management App:                 $0 additional
Database (Supabase):            $0 (free tier)
Email (100 accounts):           $0 (included)
SSL Certificates:               $0 (free)
Domain:                         $0 (if included) or $12/year

TOTAL ADDITIONAL COST:          $0-1/month 🎉
```

---

## 🆚 **Hostinger vs Vercel/Railway**

| Feature | Hostinger (You Have This!) | Vercel/Railway |
|---------|---------------------------|----------------|
| **Cost** | $0 (already paid) | $0-8/month |
| **PHP Support** | ✅ Yes | ❌ No |
| **Node.js** | ✅ Yes | ✅ Yes |
| **Email** | ✅ 100 accounts | ❌ Need separate service |
| **Auto-deploy** | ⚠️ Manual or Git hooks | ✅ Automatic |
| **Performance** | Good | Excellent |
| **Ease** | Medium | Easy |
| **Verdict** | ⭐⭐⭐ Best value! | ⭐⭐ More modern |

**For you: Hostinger wins because you already have it!**

---

## 🚀 **Quick Start Commands**

### **Deploy Public Website (5 minutes)**
```bash
# Via File Manager or FTP - just upload files!
```

### **Deploy Management App (30 minutes)**
```bash
# Connect via SSH
ssh username@yourdomain.com -p 65002

# Clone repo
cd ~
mkdir app && cd app
git clone https://github.com/SevenCandid/UPP-Management-App.git
cd UPP-Management-App

# Setup
npm install
nano .env.local  # Add Supabase credentials
npm run build

# Start with PM2
npm install -g pm2
pm2 start npm --name "upp-app" -- start
pm2 startup
pm2 save

# Done! ✅
```

---

## 🐛 **Troubleshooting**

### **Issue: Node.js version too old**

```bash
# Update Node.js
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.0/install.sh | bash
source ~/.bashrc
nvm install 18
nvm use 18
```

### **Issue: PM2 not found**

```bash
# Install globally with correct path
npm install -g pm2 --prefix ~/.npm-global
export PATH=~/.npm-global/bin:$PATH
echo 'export PATH=~/.npm-global/bin:$PATH' >> ~/.bashrc
```

### **Issue: App not accessible**

```bash
# Check if running
pm2 status

# Check logs
pm2 logs upp-app

# Restart
pm2 restart upp-app
```

### **Issue: File upload not working**

```bash
# Set correct permissions
chmod 755 ~/public_html/uploads/
chmod 644 ~/public_html/upload.php
```

---

## 📞 **Need Help?**

Hostinger has:
- ✅ 24/7 Live chat support
- ✅ Knowledge base
- ✅ Video tutorials
- ✅ Email support

They can help with:
- SSH access issues
- Node.js setup
- Domain configuration
- Email setup

---

## 🎯 **Summary**

**You're in a GREAT position!**

✅ You have premium hosting for 4 years (already paid!)
✅ Can host both apps for $0 additional cost
✅ Includes 100 email accounts
✅ Includes free SSL
✅ Supports both PHP and Node.js

**Total savings vs paying for additional hosting: $100-400/year!** 💰

---

## 🚀 **Ready to Deploy?**

Let me know if you want help with:
1. ✅ Uploading the public website
2. ✅ Deploying the Next.js app via SSH
3. ✅ Setting up the subdomain
4. ✅ Configuring professional emails
5. ✅ Testing everything

**Say "Let's deploy on Hostinger!" and we'll start!** 🎊


