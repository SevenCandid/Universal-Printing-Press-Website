# 🚀 GitHub Auto-Deployment Setup for Hostinger

This guide will help you set up automatic deployment from GitHub to your Hostinger hosting.

## ✅ What This Does

- **Automatic Deployment**: Every time you push code to the `main` or `master` branch, your website will automatically deploy to Hostinger
- **No Manual Upload**: No more manually uploading files via FTP or File Manager
- **Easy Updates**: Just push to GitHub, and your site updates automatically!

## 📋 Prerequisites

1. ✅ Your code is already on GitHub
2. ✅ You have access to your Hostinger FTP credentials
3. ✅ You have admin access to your GitHub repository

## 🔐 Step 1: Get Your Hostinger FTP Credentials

### Option A: From Hostinger hPanel

1. Log in to your Hostinger hPanel
2. Go to **"Files"** → **"FTP Accounts"**
3. Find your main FTP account (usually uses your main domain)
4. Click **"Manage"** or **"Change Password"** to view/update credentials
5. Note down:
   - **FTP Server/Host** (e.g., `ftp.yourdomain.com` or `yourdomain.com`)
   - **FTP Username** (usually `username@yourdomain.com` or just `username`)
   - **FTP Password** (you may need to reset it)

### Option B: Create a New FTP Account (Recommended)

1. In hPanel, go to **"Files"** → **"FTP Accounts"**
2. Click **"Create FTP Account"**
3. Set:
   - **FTP Username**: `github-deploy` (or any name you like)
   - **FTP Password**: Create a strong password
   - **Directory**: `/public_html` (or leave blank for root access)
4. Click **"Create"**
5. Note down the credentials

## 🔑 Step 2: Add GitHub Secrets

GitHub Secrets store your FTP credentials securely so the workflow can use them.

1. Go to your GitHub repository
2. Click **"Settings"** (top menu)
3. In the left sidebar, click **"Secrets and variables"** → **"Actions"**
4. Click **"New repository secret"** button
5. Add these three secrets:

### Secret 1: FTP_SERVER
- **Name**: `FTP_SERVER`
- **Value**: Your FTP server host (e.g., `ftp.yourdomain.com` or `ftp.hostinger.com`)
- Click **"Add secret"**

### Secret 2: FTP_USERNAME
- **Name**: `FTP_USERNAME`
- **Value**: Your FTP username (e.g., `username@yourdomain.com` or `github-deploy@yourdomain.com`)
- Click **"Add secret"**

### Secret 3: FTP_PASSWORD
- **Name**: `FTP_PASSWORD`
- **Value**: Your FTP password
- Click **"Add secret"**

**Example:**
```
FTP_SERVER: ftp.yourdomain.com
FTP_USERNAME: github-deploy@yourdomain.com
FTP_PASSWORD: YourSecurePassword123!
```

## ✅ Step 3: Verify Workflow File

The workflow file (`.github/workflows/deploy.yml`) is already created. It will:
- ✅ Deploy on push to `main` or `master` branch
- ✅ Allow manual triggering
- ✅ Exclude unnecessary files (node_modules, .git, docs, etc.)
- ✅ Upload files to `/public_html/` directory

## 🚀 Step 4: Test the Deployment

### Method 1: Push to Main Branch

```bash
# Make a small change to your code
# Then commit and push:
git add .
git commit -m "Test auto-deployment"
git push origin main
```

### Method 2: Manual Trigger

1. Go to your GitHub repository
2. Click **"Actions"** tab
3. Select **"Deploy to Hostinger"** workflow
4. Click **"Run workflow"** button (top right)
5. Select branch (usually `main`)
6. Click **"Run workflow"**

## 📊 Step 5: Monitor Deployment

1. Go to **"Actions"** tab in your GitHub repository
2. Click on the latest workflow run
3. Watch the deployment progress in real-time
4. Check for any errors (they'll be highlighted in red)

## ✅ Deployment Checklist

After setup, verify:

- [ ] GitHub secrets are configured (FTP_SERVER, FTP_USERNAME, FTP_PASSWORD)
- [ ] Workflow file exists (`.github/workflows/deploy.yml`)
- [ ] Test push triggers deployment
- [ ] Files appear on Hostinger after deployment
- [ ] Website works correctly after deployment

## 🐛 Troubleshooting

### Issue: "FTP connection failed"

**Solution:**
- Verify FTP credentials in GitHub secrets
- Check if FTP server address is correct (try `ftp.yourdomain.com` or just `yourdomain.com`)
- Ensure FTP account has access to `/public_html/` directory
- Try creating a new FTP account with explicit `/public_html` access

### Issue: "Files not uploading"

**Solution:**
- Check if FTP account has write permissions
- Verify the `server-dir` path in workflow (should be `/public_html/`)
- Check Hostinger file permissions (should be 755 for directories, 644 for files)

### Issue: "Workflow not triggering"

**Solution:**
- Ensure you're pushing to `main` or `master` branch
- Check GitHub Actions is enabled for your repository (Settings → Actions → General)
- Verify workflow file syntax is correct

### Issue: "Some files missing after deployment"

**Solution:**
- Check the `exclude` section in workflow - files might be intentionally excluded
- Add files to deployment if needed by modifying the workflow

## 📝 Customization

### Change Deployment Directory

If you need to deploy to a different directory, edit `.github/workflows/deploy.yml`:

```yaml
server-dir: /public_html/subdirectory/
```

### Exclude Additional Files

Edit the `exclude` section:

```yaml
exclude: |
  **/.git*
  **/your-folder-to-exclude/**
  **/*.log
```

### Deploy to Multiple Branches

Edit the trigger section:

```yaml
on:
  push:
    branches:
      - main
      - develop
      - production
```

## 🔒 Security Best Practices

1. ✅ **Never commit FTP credentials** to your repository
2. ✅ **Use GitHub Secrets** (already set up)
3. ✅ **Create a dedicated FTP account** for deployments (not your main account)
4. ✅ **Use strong passwords** for FTP accounts
5. ✅ **Review deployment logs** regularly

## 📞 Need Help?

If you encounter issues:
1. Check the GitHub Actions logs for detailed error messages
2. Verify all secrets are set correctly
3. Test FTP credentials manually with an FTP client
4. Contact Hostinger support for FTP-related issues

## 🎉 You're All Set!

Once configured, every push to your main branch will automatically deploy to Hostinger. Enjoy hassle-free deployments! 🚀





