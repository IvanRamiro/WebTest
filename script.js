document.addEventListener("DOMContentLoaded", function () {
    // Cache frequently accessed elements
    const navbarToggler = document.querySelector(".navbar-toggler");
    const navbarNav = document.querySelector("#navbarNav");
    const footer = document.getElementById("footer");
    const section = document.getElementById("news-events");
    const buttons = document.querySelectorAll(".btn-primary");

    // Navbar Toggler (for mobile menu)
    if (navbarToggler && navbarNav) {
        navbarToggler.addEventListener("click", () => {
            navbarNav.classList.toggle("show");
            navbarNav.style.transition = "all 0.3s ease-in-out"; // Smooth animation
        });
    }

    // Scroll Reveal Effect for News Section
    function revealOnScroll() {
        if (!section) return;

        const sectionTop = section.getBoundingClientRect().top;
        const windowHeight = window.innerHeight;

        if (sectionTop < windowHeight - 100) {
            section.classList.add("show");
            section.style.transition = "opacity 0.5s ease-in-out"; // Smooth fade-in
        }
    }

    // Footer Reveal on Scroll
    function toggleFooter() {
        if (!footer) return;

        if (window.scrollY > 500) {
            footer.classList.add("show-footer");
            footer.style.transition = "all 0.5s ease-in-out"; // Smooth animation
        } else {
            footer.classList.remove("show-footer");
        }
    }

    // Debounce function to improve scroll performance
    function debounce(func, wait = 20) {
        let timeout;
        return function (...args) {
            const later = () => {
                clearTimeout(timeout);
                func.apply(this, args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Attach scroll event listeners with debounce
    window.addEventListener("scroll", debounce(() => {
        revealOnScroll();
        toggleFooter();
    }));

    // Button Click Alert (Future Feature)
    buttons.forEach(button => {
        button.addEventListener("click", () => {
            alert("Feature coming soon!");
        });
    });

    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener("click", function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute("href"));
            if (target) {
                target.scrollIntoView({
                    behavior: "smooth"
                });
            }
        });
    });

    // Ensure the carousel starts automatically with a 3-second interval
    const mockupSlider = document.querySelector('#mockupSlider');
    if (mockupSlider) {
        new bootstrap.Carousel(mockupSlider, {
            interval: 3000, // 3 seconds
            ride: 'carousel'
        });
    }
});

// Reusable navigation function
function navigateTo(page) {
    if (page) {
        window.location.href = `${page}.html`;
    }
}

// Navigation functions
function openAffordabilityAssessment() {
    navigateTo("affordability-assessment");
}

function reviewAssessmentResult() {
    navigateTo("review-assessment-result");
}

function navigateToLoan() {
    navigateTo("loan");
}

function navigateToHelpSupport() {
    navigateTo("help-support");
}

function navigateToConsumerProtection() {
    navigateTo("consumer-protection");
}

function navigateToAboutUs() {
    navigateTo("about-us");
}

function navigateToCareers() {
    navigateTo("careers");
}

function navigateToNewsAndEvents() {
    navigateTo("news-and-events");
}

function navigateToContactUs() {
    navigateTo("contact-us");
}

// Reusable email function
function sendEmail(email) {
    if (email) {
        window.location.href = `mailto:${email}`;
    }
}

// Contact functions
function callPhoneNumber() {
    window.location.href = "tel:+63253102796";
}

function emailWeCare() {
    sendEmail("wecare@qcreditcorp.net");
}

function emailHiring() {
    sendEmail("hiring@qcreditcorp.net");
}

function emailIReport() {
    sendEmail("ireport@qcreditcorp.net");
}
