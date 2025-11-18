# 🚀 Universal Printing Press - Complete Deployment Guide

This guide covers deploying **both** your public website and management app to Railway.

---

## 📦 **What We're Deploying**

### 1. **Public Website** (HTML/CSS/JS)
- Location: Root folder (`index.html`, `styles.css`, etc.)
- Tech: Static HTML, PHP for contact forms
- Will be at: `uppsampa.com` or `upp-website.up.railway.app`

### 2. **Management App** (Next.js)
- Location: `universal-printing-press-app/` folder
- Tech: Next.js 15, React 19, TypeScript, Supabase
- Will be at: `app.uppsampa.com` or `upp-app.up.railway.app`

---

## 🎯 **Step-by-Step Deployment**

### **STEP 1: Create GitHub Repositories**

#### **Option A: Two Separate Repos** (RECOMMENDED)

**Repo 1: Public Website**
```bash
# Already done! ✅
https://github.com/SevenCandid/Universal-Printing-Press-Website
```

**Repo 2: Management App** (Let's create this)
```bash
# We'll do this together
https://github.com/SevenCandid/Universal-Printing-Press-App
```

#### **Why Separate Repos?**
- ✅ Easier deployment
- ✅ Independent updates
- ✅ Better organization
- ✅ Cleaner git history

---

### **STEP 2: Push Management App to GitHub**

Run these commands:

```bash
# Navigate to the app folder
cd universal-printing-press-app

# Initialize git (if not already done)
git init

# Add all files
git add .

# Commit
git commit -m "Initial commit: UPP Management App with Next.js 15, Supabase, PWA features"

# Create the repo on GitHub first, then:
git remote add origin https://github.com/SevenCandid/Universal-Printing-Press-App.git

# Rename branch to main
git branch -M main

# Push to GitHub
git push -u origin main
```

---

### **STEP 3: Deploy to Railway**

#### **3A: Deploy Management App (Next.js)**

1. **Go to Railway.app**
   - Visit: https://railway.app
   - Click "Start a New Project"
   - Sign in with GitHub

2. **Deploy from GitHub**
   ```
   • Click "Deploy from GitHub repo"
   • Select: Universal-Printing-Press-App
   • Railway auto-detects Next.js
   • Click "Deploy Now"
   ```

3. **Add Environment Variables**
   ```
   In Railway Dashboard:
   • Click your service
   • Go to "Variables" tab
   • Add:
     NEXT_PUBLIC_SUPABASE_URL=https://mtyhkxufhyuctljchcwh.supabase.co
     NEXT_PUBLIC_SUPABASE_ANON_KEY=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...
   ```

4. **Get Your URL**
   ```
   Railway will give you:
   https://universal-printing-press-app.up.railway.app
   
   Or add custom domain:
   app.uppsampa.com
   ```

#### **3B: Deploy Public Website (Static)**

1. **Create New Service**
   ```
   • In same Railway project, click "New"
   • Select "GitHub Repo"
   • Choose: Universal-Printing-Press-Website
   ```

2. **Configure Deployment**
   
   Since it's static HTML with PHP, Railway needs a config.
   
   **Option 1: Use Nginx (for PHP)**
   Railway can serve PHP files with proper configuration.

   **Option 2: Remove PHP, Use Static**
   Convert contact.php to an API endpoint in the Next.js app.

3. **Get Your URL**
   ```
   https://universal-printing-press-website.up.railway.app
   ```

---

### **STEP 4: Connect Custom Domain** (Optional)

If you have `uppsampa.com`:

1. **In Railway:**
   ```
   Management App Service:
   • Settings → Domains
   • Add: app.uppsampa.com
   
   Website Service:
   • Settings → Domains  
   • Add: uppsampa.com or www.uppsampa.com
   ```

2. **In Your Domain Registrar:**
   ```
   Add CNAME records:
   
   Host: app
   Points to: [Railway provides this]
   
   Host: @
   Points to: [Railway provides this]
   ```

---

## 💰 **Cost Estimation**

### **Railway Costs (Pay as you go)**

```
Management App (Next.js):
• CPU: ~$3/month
• Memory: ~$2/month
• Build time: ~$0.50/month
Subtotal: ~$5-6/month

Public Website (Static):
• CPU: ~$1/month  
• Memory: ~$1/month
Subtotal: ~$2/month

──────────────────────────
TOTAL: ~$7-8/month
```

### **Supabase Costs**

```
Free Tier:
• 500 MB database
• 2 GB file storage
• 50,000 monthly active users
• 500 MB egress
Cost: $0/month ✅

Pro Tier (if you need more):
• 8 GB database
• 100 GB file storage  
• 100,000 monthly active users
Cost: $25/month
```

### **Grand Total**

```
Railway: $7-8/month
Supabase: $0/month (Free tier)
Domain: $12/year (~$1/month)
──────────────────────────
TOTAL: ~$8-9/month 🎉
```

---

## 🔥 **Alternative: Hostinger (Cheaper but Less Modern)**

If budget is critical:

```
Hostinger Premium: $2.99/month
• Host both website + Next.js app
• Need Node.js support
• MySQL database included
• Email accounts included

But Railway is better for:
✅ Auto-deployment
✅ Scaling
✅ Modern workflow
✅ Git integration
```

---

## 📋 **What to Do Next**

1. **Create the management app GitHub repo**
2. **Push the app to GitHub**
3. **Deploy on Railway** (5 minutes!)
4. **Test everything**
5. **Add custom domain** (optional)

---

## ❓ **Need Help?**

Let me know:
1. Do you want me to help create the GitHub repo for the management app?
2. Should I write a script to automate the deployment?
3. Do you want to deploy on Railway or try Hostinger first?

Choose and we'll proceed! 🚀


