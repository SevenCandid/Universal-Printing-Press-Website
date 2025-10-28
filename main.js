// =======================
// Universal Printing Press - Main JavaScript
// =======================


document.addEventListener("DOMContentLoaded", function() {
    const navbar = document.querySelector("navbar"); // Adjust selector if your navbar tag isn't <nav>
    const hero = document.querySelector("#home.hero");
    if (navbar && hero) {
        hero.style.marginTop = navbar.offsetHeight + "px";
    }
});



class UniversalPrintingApp {
    constructor() {
        this.indexSlogans = ["You think it, We ink it", "Quality Printing Solutions", "Your Vision, Our Precision"];
        this.serviceSlogans = ["Quality Printing Solutions", "Your Vision, Our Precision", "Innovative Designs"];
        this.sloganIntervals = {};
        this.currentSloganIndexes = {};
        this.init();
    }

    // =======================
    // INIT
    // =======================
    init() {
        this.setupEventListeners();
        this.setupThemeToggle();
        this.setupMobileMenu();
        this.setupScrollEffects();
        this.setupAnimations();
        this.setupRotatingSlogans();
        this.setupFormHandlers();
        this.setupBackToTop();
        this.setupMouseAnimation();
        this.setupFAQ();
        this.setupHeroSlider();
        this.setupStatCounters();
    }

    // =======================
    // Smooth Scroll Links
    // =======================
    setupEventListeners() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener("click", e => {
                e.preventDefault();
                const target = document.querySelector(anchor.getAttribute("href"));
                if (target) {
                    const headerHeight = document.querySelector("header").offsetHeight;
                    const targetPosition = target.offsetTop - headerHeight;
                    window.scrollTo({ top: targetPosition, behavior: "smooth" });
                }
            });
        });

        document.querySelectorAll(".nav-links a").forEach(link => {
            link.addEventListener("click", () => this.closeMobileMenu());
        });
    }

    // =======================
    // Theme Toggle with Beautiful Animation
    // =======================
    setupThemeToggle() {
        const themeToggle = document.querySelector("#themeToggle");
        if (!themeToggle) return;

        // Load saved theme or default to light
        const savedTheme = localStorage.getItem("theme") || "light";
        this.setTheme(savedTheme, false); // false = no animation on page load

        themeToggle.addEventListener("click", () => {
            // Add pulse animation
            themeToggle.classList.add("toggling");
            
            // Remove animation class after animation completes
            setTimeout(() => {
                themeToggle.classList.remove("toggling");
            }, 600);

            // Toggle theme
            const currentTheme = document.documentElement.getAttribute("data-theme") || "light";
            const newTheme = currentTheme === "light" ? "dark" : "light";
            this.setTheme(newTheme, true);
        });
    }

    setTheme(theme, animate = true) {
        // Set the theme attribute
        document.documentElement.setAttribute("data-theme", theme);
        localStorage.setItem("theme", theme);

        // Add smooth transition class for theme change
        if (animate) {
            document.body.style.transition = "background-color 0.3s ease, color 0.3s ease";
            setTimeout(() => {
                document.body.style.transition = "";
            }, 300);
        }

        // Update meta theme color for mobile browsers
        const metaThemeColor = document.querySelector('meta[name="theme-color"]');
        if (metaThemeColor) {
            metaThemeColor.setAttribute("content", theme === "dark" ? "#14182e" : "#ffffff");
        } else {
            const meta = document.createElement("meta");
            meta.name = "theme-color";
            meta.content = theme === "dark" ? "#14182e" : "#ffffff";
            document.head.appendChild(meta);
        }
    }

    // =======================
    // Mobile Menu with Overlay
    // =======================
    setupMobileMenu() {
        const hamburger = document.querySelector(".hamburger");
        const navLinks = document.querySelector(".nav-links");

        // Create overlay element
        let overlay = document.querySelector(".mobile-menu-overlay");
        if (!overlay) {
            overlay = document.createElement("div");
            overlay.className = "mobile-menu-overlay";
            document.body.appendChild(overlay);
        }

        if (hamburger && navLinks) {
            // Toggle menu on hamburger click
            hamburger.addEventListener("click", (e) => {
                e.stopPropagation();
                this.toggleMobileMenu();
            });

            // Close menu when clicking overlay
            overlay.addEventListener("click", () => {
                this.closeMobileMenu();
            });

            // Close menu when clicking outside
            document.addEventListener("click", (e) => {
                if (!hamburger.contains(e.target) && 
                    !navLinks.contains(e.target) && 
                    navLinks.classList.contains("active")) {
                    this.closeMobileMenu();
                }
            });

            // Prevent menu from closing when clicking inside it
            navLinks.addEventListener("click", (e) => {
                e.stopPropagation();
            });
        }
    }

    toggleMobileMenu() {
        const hamburger = document.querySelector(".hamburger");
        const navLinks = document.querySelector(".nav-links");
        const overlay = document.querySelector(".mobile-menu-overlay");
        const body = document.body;

        if (hamburger && navLinks) {
            const isActive = hamburger.classList.toggle("active");
            navLinks.classList.toggle("active");
            
            if (overlay) {
                overlay.classList.toggle("active");
            }

            // Prevent body scroll when menu is open
            if (isActive) {
                body.classList.add("menu-open");
            } else {
                body.classList.remove("menu-open");
            }
        }
    }

    closeMobileMenu() {
        const hamburger = document.querySelector(".hamburger");
        const navLinks = document.querySelector(".nav-links");
        const overlay = document.querySelector(".mobile-menu-overlay");
        const body = document.body;

        if (hamburger && navLinks) {
            hamburger.classList.remove("active");
            navLinks.classList.remove("active");
            
            if (overlay) {
                overlay.classList.remove("active");
            }

            body.classList.remove("menu-open");
        }
    }

    // =======================
    // Scroll Effects
    // =======================
    setupScrollEffects() {
        const header = document.querySelector("header");
        const backToTop = document.querySelector(".back-to-top");
        window.addEventListener("scroll", this.throttle(() => {
            const scrollY = window.scrollY;
            if (header) {
                if (scrollY > 100) header.classList.add("scrolled");
                else header.classList.remove("scrolled");
            }
            if (backToTop) {
                if (scrollY > 300) backToTop.classList.add("active");
                else backToTop.classList.remove("active");
            }
            this.revealOnScroll();
        }, 16));
    }

    revealOnScroll() {
        const elements = document.querySelectorAll(".service-card, .portfolio-item, .stat-item, .card, .cta h2, .cta p");
        elements.forEach((element) => {
            const elementTop = element.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;
            if (elementTop < windowHeight - 100) {
                element.style.opacity = "1";
                element.style.transform = "translateY(0)";
            }
        });
    }

    setupAnimations() {
        const elementsToAnimate = document.querySelectorAll(".service-card, .portfolio-item, .stat-item, .card");
        elementsToAnimate.forEach((element) => {
            element.style.opacity = "0";
            element.style.transform = "translateY(20px)";
            element.style.transition = "opacity 0.6s ease, transform 0.6s ease";
        });
        this.setupCounterAnimation();
    }

    setupCounterAnimation() {
        const statsSection = document.querySelector(".stats-container");
        if (!statsSection) return;
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    this.animateCounters();
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        observer.observe(statsSection);
    }

    animateCounters() {
        const counters = document.querySelectorAll(".stat-number");
        counters.forEach((counter) => {
            const target = Number.parseInt(counter.textContent.replace(/\D/g, ""));
            const duration = 2000;
            const step = target / (duration / 16);
            let current = 0;
            const timer = setInterval(() => {
                current += step;
                if (current >= target) {
                    counter.textContent = counter.textContent.replace(/\d+/, target.toString());
                    clearInterval(timer);
                } else {
                    counter.textContent = counter.textContent.replace(/\d+/, Math.floor(current).toString());
                }
            }, 16);
        });
    }

    // =======================
    // Rotating Slogans
    // =======================
    setupRotatingSlogans() {
        const sloganContainers = document.querySelectorAll(".rotating-slogan");
        sloganContainers.forEach((container, index) => {
            const pageId = container.closest("section.hero").id || `slogan-${index}`;
            this.currentSloganIndexes[pageId] = 0;
            let slogansArray;
            if (container.closest(".home-hero") || container.closest(".portfolio-hero")) {
                slogansArray = this.indexSlogans;
            } else if (container.closest(".service-hero")) {
                slogansArray = this.serviceSlogans;
            } else {
                slogansArray = Array.from(container.querySelectorAll(".slogan-text")).map((span) => span.textContent);
            }
            container.innerHTML = "";
            slogansArray.forEach((slogan, i) => {
                const sloganSpan = document.createElement("span");
                sloganSpan.className = `slogan-text ${i === 0 ? "active" : ""}`;
                sloganSpan.textContent = slogan;
                container.appendChild(sloganSpan);
            });
            if (slogansArray.length > 0) {
                this.sloganIntervals[pageId] = setInterval(() => {
                    this.rotateSlogan(container, pageId, slogansArray);
                }, 3000);
            }
        });
    }

    rotateSlogan(container, pageId, slogansArray) {
        const sloganTexts = container.querySelectorAll(".slogan-text");
        if (sloganTexts.length === 0) return;
        sloganTexts[this.currentSloganIndexes[pageId]].classList.remove("active");
        this.currentSloganIndexes[pageId] = (this.currentSloganIndexes[pageId] + 1) % slogansArray.length;
        sloganTexts[this.currentSloganIndexes[pageId]].classList.add("active");
    }

    // =======================
    // FORM HANDLERS
    // =======================
    setupFormHandlers() {
        const contactForm = document.getElementById("contactForm");
        if (contactForm) {
            contactForm.addEventListener("submit", (e) => {
                e.preventDefault();
                this.handleContactForm(e.target);
            });
        }
    }

    handleContactForm(form) {
        const formData = new FormData(form);
        fetch("contact.php", {
            method: "POST",
            body: formData
        })
        .then(res => res.text())
        .then(response => {
            console.log("Server response:", response);
            if (response.trim().toLowerCase() === "success") {
                this.showNotification("Thank you for your message! We will get back to you soon.", "success");
                form.reset();
            } else {
                this.showNotification(response, "error");
            }
        })
        .catch(error => {
            this.showNotification("There was an error sending your message. Please try again.", "error");
            console.error("Contact form error:", error);
        });
    }

    // =======================
    // Back to Top
    // =======================
    setupBackToTop() {
        let backToTop = document.querySelector(".back-to-top");
        if (!backToTop) {
            backToTop = document.createElement("div");
            backToTop.className = "back-to-top";
            backToTop.innerHTML = '<i class="fas fa-chevron-up"></i>';
            document.body.appendChild(backToTop);
        }
        backToTop.addEventListener("click", () => {
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    }

    // =======================
    // Mouse Animation
    // =======================
    setupMouseAnimation() {
        const mouseContainers = document.querySelectorAll(".comp-mouse-container");
        mouseContainers.forEach((mouseContainer) => {
            const computerMouse = mouseContainer.querySelector(".comp-mouse");
            if (computerMouse) {
                // Make dancing start immediately on mobile, with delay on desktop
                const isMobile = window.innerWidth <= 768;
                const delay = isMobile ? 0 : 1500;
                
                setTimeout(() => {
                    mouseContainer.classList.add("dancing");
                }, delay);
                
                computerMouse.addEventListener("click", () => {
                    mouseContainer.classList.toggle("dancing");
                });
            }
        });
    }

    // =======================
    // Animated Stat Counters
    // =======================
    setupStatCounters() {
        const statNumbers = document.querySelectorAll(".stat-number[data-target]");
        
        const animateCounter = (element) => {
            const target = parseInt(element.getAttribute("data-target"));
            const duration = 2000; // 2 seconds
            const increment = target / (duration / 16); // 60fps
            let current = 0;
            
            const updateCounter = () => {
                current += increment;
                if (current < target) {
                    element.textContent = Math.floor(current);
                    requestAnimationFrame(updateCounter);
                } else {
                    element.textContent = target + (target >= 100 ? "" : "+");
                }
            };
            
            updateCounter();
        };
        
        // Intersection Observer for animation trigger
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.classList.contains("counted")) {
                    entry.target.classList.add("counted");
                    animateCounter(entry.target);
                }
            });
        }, { threshold: 0.5 });
        
        statNumbers.forEach(stat => observer.observe(stat));
    }

    // =======================
    // FAQ
    // =======================
    setupFAQ() {
        const faqItems = document.querySelectorAll(".faq-item");
        faqItems.forEach((item) => {
            const question = item.querySelector(".faq-question");
            if (question) {
                question.addEventListener("click", () => {
                    faqItems.forEach((otherItem) => {
                        if (otherItem !== item && otherItem.classList.contains("active")) {
                            otherItem.classList.remove("active");
                        }
                    });
                    item.classList.toggle("active");
                });
            }
        });
    }

    // =======================
    // HERO SLIDER
    // =======================
    setupHeroSlider() {
        const slides = document.querySelectorAll(".hero-slide");
        const dots = document.querySelectorAll(".hero-slider-dots .dot");
        
        if (slides.length === 0) return;

        let currentSlide = 0;
        let slideInterval;

        // Function to show specific slide
        const showSlide = (index) => {
            // Remove active class from all slides and dots
            slides.forEach(slide => slide.classList.remove("active"));
            dots.forEach(dot => dot.classList.remove("active"));

            // Add active class to current slide and dot
            slides[index].classList.add("active");
            if (dots[index]) {
                dots[index].classList.add("active");
            }

            currentSlide = index;
        };

        // Function to go to next slide
        const nextSlide = () => {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        };

        // Auto-play slider (change image every 5 seconds)
        const startAutoPlay = () => {
            slideInterval = setInterval(nextSlide, 5000); // 5 seconds per slide
        };

        // Stop auto-play
        const stopAutoPlay = () => {
            clearInterval(slideInterval);
        };

        // Dot navigation click handlers
        dots.forEach((dot, index) => {
            dot.addEventListener("click", () => {
                stopAutoPlay();
                showSlide(index);
                startAutoPlay(); // Restart auto-play after manual navigation
            });
        });

        // Keyboard navigation (optional)
        document.addEventListener("keydown", (e) => {
            if (e.key === "ArrowLeft") {
                stopAutoPlay();
                currentSlide = (currentSlide - 1 + slides.length) % slides.length;
                showSlide(currentSlide);
                startAutoPlay();
            } else if (e.key === "ArrowRight") {
                stopAutoPlay();
                nextSlide();
                startAutoPlay();
            }
        });

        // Pause slider when user hovers over hero section
        const heroSection = document.querySelector(".hero");
        if (heroSection) {
            heroSection.addEventListener("mouseenter", stopAutoPlay);
            heroSection.addEventListener("mouseleave", startAutoPlay);
        }

        // Start the auto-play
        startAutoPlay();
    }

    // =======================
    // Notifications
    // =======================
    showNotification(message, type = "info") {
        const notification = document.createElement("div");
        notification.className = `notification ${type}`;
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 10000;
            padding: 15px 20px;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            transform: translateX(100%);
            transition: transform 0.3s ease;
            max-width: 300px;
        `;
        switch (type) {
            case "success":
                notification.style.backgroundColor = "#28a745";
                break;
            case "error":
                notification.style.backgroundColor = "#dc3545";
                break;
            default:
                notification.style.backgroundColor = "#007bff";
        }
        notification.textContent = message;
        document.body.appendChild(notification);
        setTimeout(() => {
            notification.style.transform = "translateX(0)";
        }, 100);
        setTimeout(() => {
            notification.style.transform = "translateX(100%)";
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 300);
        }, 5000);
    }

    throttle(func, limit) {
        let inThrottle;
        return function () {
            const args = arguments;
            if (!inThrottle) {
                func.apply(this, args);
                inThrottle = true;
                setTimeout(() => (inThrottle = false), limit);
            }
        }
    }
}

// =======================
// INIT APP
// =======================
document.addEventListener("DOMContentLoaded", () => {
    new UniversalPrintingApp();
});


// Add to main.js
//document.getElementById('newsletterForm').addEventListener('submit', function(e) {
 // e.preventDefault();
  //document.getElementById('newsletterMessage').textContent = "Thank you for subscribing!";
 // this.reset();
//});

// ...existing code...
//const newsletterForm = document.getElementById('newsletterForm');
//if (newsletterForm) {
 // newsletterForm.addEventListener('submit', function(e) {
  //  e.preventDefault();
  //  const formData = new FormData(this);
  //  fetch('newsletter.php', {
   //   method: 'POST',
 //     body: formData
  //  })
   // .then(res => res.text())
   // .then(response => {
    //  document.getElementById('newsletterMessage').textContent = response;
    //  this.reset();
   // })
   // .catch(() => {
    //  document.getElementById('newsletterMessage').textContent = "There was an error. Please try again.";
   // });
 // });
//}