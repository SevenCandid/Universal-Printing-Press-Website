# Uploads Directory

This directory stores files uploaded by users through the order form.

## Setup Instructions

1. **Set Permissions:** This folder must have **755** permissions on the server
2. **Location:** Files uploaded through the order form will appear here
3. **Security:** The `.htaccess` file prevents PHP execution in this directory

## File Management

- Files are automatically named with timestamps to prevent conflicts
- Maximum file size: 20 MB per file
- Allowed extensions: pdf, jpg, jpeg, png, ai, psd, doc, docx
- Files are attached to order emails automatically

## On Hostinger

When deploying, ensure:
1. This folder exists in `public_html/uploads/`
2. Permissions are set to **755**
3. The folder is not publicly browsable (handled by `.htaccess`)

