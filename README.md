# 🖨️ Universal Printing Press Website

![License](https://img.shields.io/badge/license-MIT-blue.svg)
![Version](https://img.shields.io/badge/version-1.0.0-green.svg)
![Status](https://img.shields.io/badge/status-active-success.svg)

A modern, responsive, and feature-rich website for **Universal Printing Press** - Your trusted partner for all printing needs in Sampa, Ghana.

## ✨ Features

### 🎨 Design & UI/UX
- **Modern Responsive Design** - Fully optimized for desktop, tablet, and mobile devices
- **Dark/Light Theme Toggle** - User preference with persistent storage
- **Smooth Animations** - Engaging transitions and hover effects throughout
- **Glassmorphism Effects** - Beautiful frosted glass UI elements
- **Hero Image Slider** - Auto-playing carousel with 5 stunning images and smooth Ken Burns effect

### 🎯 Key Sections
- **Home Page** - Dynamic hero section with rotating slogans and call-to-action buttons
- **About Page** - Company history, mission, vision, values, and team
- **Services Page** - Comprehensive listing of all printing services offered
- **Portfolio Page** - Showcase of completed projects with image gallery
- **Order Page** - Easy-to-use order form with file upload functionality
- **Contact Integration** - PHP-based contact form with email functionality

### 🚀 Interactive Features
- **Animated Statistics Counter** - Numbers count up when scrolling into view
- **Live Chat Widget** - Tawk.to integration for real-time customer support
- **Smooth Scrolling** - Enhanced navigation experience
- **Mobile-Optimized Menu** - Glassy overlay menu with smooth animations
- **Newsletter Subscription** - Stay connected with customers
- **Social Media Integration** - Links to WhatsApp, Instagram, TikTok, and Facebook

### 🎨 Centralized Color Management
- **Single-Click Color Change** - Change entire website accent color from one CSS variable
- **Brand Consistency** - All buttons, headings, and accents use the same color scheme
- **Easy Customization** - Simple color palette examples provided in CSS

### 🔒 Security & Backend
- **PHPMailer Integration** - Secure email functionality for contact forms
- **File Upload System** - For logo/design submissions
- **Form Validation** - Client-side and server-side validation

## 🛠️ Technologies Used

- **HTML5** - Semantic markup structure
- **CSS3** - Modern styling with custom properties, flexbox, and grid
- **JavaScript (ES6+)** - Interactive features and DOM manipulation
- **PHP** - Backend form processing and email sending
- **PHPMailer** - Email library for contact forms
- **Font Awesome** - Icon library
- **Tawk.to** - Live chat integration

## 📁 Project Structure

```
Universal-Printing-Press-Website/
├── index.html              # Home page
├── about.html              # About page
├── service.html            # Services page
├── portfolio.html          # Portfolio/gallery page
├── order.html              # Order form page
├── contact.php             # Contact form handler
├── upload.php              # File upload handler
├── styles.css              # Main stylesheet (5,300+ lines)
├── main.js                 # JavaScript functionality
├── favicon.png             # Website favicon
├── .gitignore              # Git ignore rules
├── PHPMailer/              # Email library
│   └── src/
│       ├── PHPMailer.php
│       ├── SMTP.php
│       └── Exception.php
├── img/                    # Image assets
│   ├── hero images
│   ├── service images
│   ├── portfolio images
│   └── logo (upplogo.png)
└── uploads/                # User uploaded files
```

## 🎨 Customization Guide

### Changing Accent Color

The entire website color scheme can be changed by editing **ONE LINE** in `styles.css`:

```css
:root {
  --accent-color: #d7dee4;  /* 👈 Change this to any color! */
}
```

**Color Examples:**
```css
/* Orange */
--accent-color: #ff9900;

/* Blue */
--accent-color: #3b82f6;

/* Purple */
--accent-color: #9333ea;

/* Green */
--accent-color: #10b981;

/* Red */
--accent-color: #ef4444;
```

This will automatically update:
- All button colors and hover effects
- Section titles and headings
- Social media icon accents
- Hero slider dots
- Form focus states
- Footer accent lines
- And all other accent elements!

## 🚀 Installation & Setup

### Prerequisites
- Web server (Apache/Nginx) with PHP 7.4+ support
- PHP mail configuration or SMTP credentials

### Local Development

1. **Clone the repository**
```bash
git clone https://github.com/SevenCandid/Universal-Printing-Press-Website.git
cd Universal-Printing-Press-Website
```

2. **Start a local server**

**Using Python:**
```bash
python -m http.server 8000
```

**Using PHP:**
```bash
php -S localhost:8000
```

3. **Open in browser**
```
http://localhost:8000
```

### Production Deployment

1. Upload all files to your web server's root directory
2. Configure PHP mail settings in `contact.php`
3. Set proper permissions for the `uploads/` directory:
```bash
chmod 755 uploads/
```
4. Update social media links and contact information in HTML files
5. Test contact form and file upload functionality

## 📧 Email Configuration

Edit `contact.php` to configure email settings:

```php
// Update with your email address
$to = "uppsampa2025@gmail.com";

// For SMTP configuration, edit PHPMailer settings
$mail->Host = 'smtp.gmail.com';
$mail->Username = 'your-email@gmail.com';
$mail->Password = 'your-app-password';
```

## 🌐 Live Demo

Visit the live website: [https://github.com/SevenCandid/Universal-Printing-Press-Website](https://github.com/SevenCandid/Universal-Printing-Press-Website)

## 📱 Features by Page

### Index (Home)
- Dynamic hero slider with 5 images
- Rotating slogan text animation
- About section with glassmorphic cards
- Achievements statistics (animated counters)
- Why Choose Us section
- Modern footer with social links

### About
- Company history timeline
- Mission, Vision & Values
- Team information
- Responsive layout

### Services
- Comprehensive service listings
- Category-based organization
- Visual service cards
- Hero slider with service-related images

### Portfolio
- Project gallery
- Category filters
- Lightbox image viewer
- Client testimonials

### Order
- Multi-step order form
- File upload for logos/designs
- Service selection
- Contact information collection

## 🎯 Browser Support

- ✅ Chrome/Edge (latest)
- ✅ Firefox (latest)
- ✅ Safari (latest)
- ✅ Mobile browsers (iOS Safari, Chrome Mobile)

## 📊 Performance Features

- Optimized images
- Minimal external dependencies
- CSS custom properties for theme switching
- Lazy loading where applicable
- Efficient JavaScript event handling

## 🤝 Contributing

Contributions, issues, and feature requests are welcome! Feel free to check the [issues page](https://github.com/SevenCandid/Universal-Printing-Press-Website/issues).

## 📝 License

This project is licensed under the MIT License - see the LICENSE file for details.

## 👨‍💻 Developer

**SevenCandid**
- GitHub: [@SevenCandid](https://github.com/SevenCandid)

## 📞 Universal Printing Press Contact

- **Location:** Awurade Na Aye Storey Building, Sampa
- **Phone:** (+233) 59-999-7279
- **Email:** uppsampa2025@gmail.com
- **Hours:** Mon-Saturday: 8AM-6PM

## 🙏 Acknowledgments

- Font Awesome for icons
- Tawk.to for live chat integration
- PHPMailer for email functionality
- All the amazing open-source contributors

---

**⭐ Star this repository if you find it helpful!**

Built with ❤️ by SevenCandid for Universal Printing Press

