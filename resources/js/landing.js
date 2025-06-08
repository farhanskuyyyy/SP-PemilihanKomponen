// import './bootstrap';

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();

import * as bootstrap from "bootstrap"; // import dan assign ke variable
import "bootstrap-icons/font/bootstrap-icons.css";
window.bootstrap = bootstrap; // expose ke global window

// Landing Page JavaScript
document.addEventListener("DOMContentLoaded", () => {
    // Navbar scroll effect
    const navbar = document.querySelector(".navbar");

    window.addEventListener("scroll", () => {
        if (window.scrollY > 50) {
            navbar.style.backgroundColor = "rgba(78, 115, 223, 0.95)";
        } else {
            navbar.style.backgroundColor = "rgba(78, 115, 223, 1)";
        }
    });

    // Smooth scrolling for navigation links
    const navLinks = document.querySelectorAll(
        '.navbar-nav .nav-link[href^="#"]'
    );

    navLinks.forEach((link) => {
        link.addEventListener("click", function (e) {
            e.preventDefault();

            const targetId = this.getAttribute("href");
            const targetSection = document.querySelector(targetId);

            if (targetSection) {
                const offsetTop = targetSection.offsetTop - 70; // Account for fixed navbar

                window.scrollTo({
                    top: offsetTop,
                    behavior: "smooth",
                });
            }
        });
    });

    // Back to top button
    const backToTopBtn = document.getElementById("backToTop");

    window.addEventListener("scroll", () => {
        if (window.scrollY > 300) {
            backToTopBtn.classList.add("show");
        } else {
            backToTopBtn.classList.remove("show");
        }
    });

    backToTopBtn.addEventListener("click", () => {
        window.scrollTo({
            top: 0,
            behavior: "smooth",
        });
    });

    // Animate stats on scroll
    const statsSection = document.querySelector(".hero-stats");
    const statNumbers = document.querySelectorAll(".stat-number");
    let statsAnimated = false;

    function animateStats() {
        if (statsAnimated) return;

        statNumbers.forEach((stat) => {
            const finalValue = stat.textContent;
            const numericValue = Number.parseInt(finalValue.replace(/\D/g, ""));
            const suffix = finalValue.replace(/\d/g, "");
            let currentValue = 0;
            const increment = numericValue / 50;

            const timer = setInterval(() => {
                currentValue += increment;
                if (currentValue >= numericValue) {
                    currentValue = numericValue;
                    clearInterval(timer);
                }
                stat.textContent = Math.floor(currentValue) + suffix;
            }, 30);
        });

        statsAnimated = true;
    }

    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px",
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                if (entry.target === statsSection) {
                    animateStats();
                }

                // Add fade-in animation to feature cards
                if (entry.target.classList.contains("feature-card")) {
                    entry.target.style.opacity = "1";
                    entry.target.style.transform = "translateY(0)";
                }

                // Add fade-in animation to step cards
                if (entry.target.classList.contains("step-card")) {
                    entry.target.style.opacity = "1";
                    entry.target.style.transform = "translateY(0)";
                }
            }
        });
    }, observerOptions);

    // Observe elements for animation
    if (statsSection) {
        observer.observe(statsSection);
    }

    document.querySelectorAll(".feature-card").forEach((card) => {
        card.style.opacity = "0";
        card.style.transform = "translateY(30px)";
        card.style.transition = "all 0.6s ease";
        observer.observe(card);
    });

    document.querySelectorAll(".step-card").forEach((card) => {
        card.style.opacity = "0";
        card.style.transform = "translateY(30px)";
        card.style.transition = "all 0.6s ease";
        observer.observe(card);
    });

    // Mobile navbar collapse
    const navbarToggler = document.querySelector(".navbar-toggler");
    const navbarCollapse = document.querySelector(".navbar-collapse");

    // Close mobile menu when clicking on a link
    navLinks.forEach((link) => {
        link.addEventListener("click", () => {
            if (navbarCollapse.classList.contains("show")) {
                navbarToggler.click();
            }
        });
    });

    // Parallax effect for hero section
    window.addEventListener("scroll", () => {
        const scrolled = window.pageYOffset;
        const parallaxElements = document.querySelectorAll(".component-card");

        parallaxElements.forEach((element, index) => {
            const speed = 0.5 + index * 0.1;
            const yPos = -(scrolled * speed);
            element.style.transform = `translateY(${yPos}px)`;
        });
    });

    // Add loading animation to buttons
    const ctaButtons = document.querySelectorAll(".btn");

    ctaButtons.forEach((button) => {
        button.addEventListener("click", function (e) {
            // Don't add loading to navigation buttons
            if (
                this.getAttribute("href") &&
                this.getAttribute("href").startsWith("#")
            ) {
                return;
            }

            const originalText = this.innerHTML;
            this.innerHTML =
                '<span class="spinner-border spinner-border-sm me-2" role="status"></span>Loading...';
            this.disabled = true;

            // Simulate loading (remove this in production)
            setTimeout(() => {
                this.innerHTML = originalText;
                this.disabled = false;
            }, 2000);
        });
    });

    // Add hover effect to component cards
    const componentCards = document.querySelectorAll(".component-card");

    componentCards.forEach((card) => {
        card.addEventListener("mouseenter", function () {
            this.style.animationPlayState = "paused";
        });

        card.addEventListener("mouseleave", function () {
            this.style.animationPlayState = "running";
        });
    });

    // Initialize tooltips if Bootstrap is available
    const bootstrap = window.bootstrap; // Declare the bootstrap variable
    if (typeof bootstrap !== "undefined") {
        const tooltipTriggerList = [].slice.call(
            document.querySelectorAll('[data-bs-toggle="tooltip"]')
        );
        const tooltipList = tooltipTriggerList.map(
            (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
        );
    }

    // Add typing effect to hero title
    const heroTitle = document.querySelector(".hero-title");
    if (heroTitle) {
        const originalText = heroTitle.innerHTML;
        heroTitle.innerHTML = "";

        let i = 0;
        const typeWriter = () => {
            if (i < originalText.length) {
                heroTitle.innerHTML += originalText.charAt(i);
                i++;
                setTimeout(typeWriter, 50);
            }
        };

        // Start typing effect after a short delay
        setTimeout(typeWriter, 500);
    }

    // Add counter animation for benefits section
    const benefitItems = document.querySelectorAll(".benefit-item");

    benefitItems.forEach((item, index) => {
        item.style.opacity = "0";
        item.style.transform = "translateX(-30px)";
        item.style.transition = `all 0.6s ease ${index * 0.1}s`;

        observer.observe(item);
    });

    // Performance optimization: Throttle scroll events
    let ticking = false;

    function updateOnScroll() {
        // Update scroll-dependent elements here
        ticking = false;
    }

    window.addEventListener("scroll", () => {
        if (!ticking) {
            requestAnimationFrame(updateOnScroll);
            ticking = true;
        }
    });

    console.log("PC Expert Landing Page Loaded Successfully! 🚀");
});
