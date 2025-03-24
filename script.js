document.addEventListener("DOMContentLoaded", function () {
    // Cache frequently accessed elements
    const navbarToggler = document.querySelector(".navbar-toggler");
    const navbarNav = document.querySelector("#navbarNav");
    const footer = document.getElementById("footer");
    const section = document.getElementById("news-events");
    const buttons = document.querySelectorAll(".btn-primary");
    const navLinks = document.querySelectorAll(".nav-link");

    // Navbar Toggler (for mobile menu)
    if (navbarToggler && navbarNav) {
        navbarToggler.addEventListener("click", () => {
            navbarNav.classList.toggle("show");
            navbarNav.style.transition = "all 0.3s ease-in-out"; // Smooth animation
        });
    }
    navLinks.forEach((link) => {
        if (link.href === window.location.href) {
            link.classList.add("active");
            link.classList.remove("inactive");
        } else {
            link.classList.add("inactive");
        }
    });

    // Optional: Add click event to highlight link on user interaction
    navLinks.forEach((link) => {
        link.addEventListener("click", function () {
            navLinks.forEach((lnk) => lnk.classList.remove("active"));
            this.classList.add("active");
        });
    });

    // Handle window resize for responsive adjustments
    window.addEventListener("resize", debounce(() => {
        if (window.innerWidth > 768) {
            navbarNav.classList.remove("show"); // Ensure menu is hidden on larger screens
        }
    }));

    // Improve accessibility for keyboard navigation
    navLinks.forEach((link) => {
        link.addEventListener("keydown", (e) => {
            if (e.key === "Enter") {
                link.click(); // Trigger click on Enter key
            }
        });
    });

    // Add ARIA attributes for better accessibility
    if (navbarToggler && navbarNav) {
        navbarToggler.setAttribute("aria-expanded", "false");
        navbarToggler.addEventListener("click", () => {
            const isExpanded = navbarNav.classList.contains("show");
            navbarToggler.setAttribute("aria-expanded", !isExpanded);
        });
    }

    // Add responsive behavior for footer
    function adjustFooter() {
        if (window.innerWidth < 768) {
            footer.style.position = "relative"; // Ensure footer is not fixed on small screens
        } else {
            footer.style.position = "fixed"; // Keep footer fixed on larger screens
        }
    }
    adjustFooter();
    window.addEventListener("resize", debounce(adjustFooter));

    // Enhance button interactivity with hover effects
    buttons.forEach(button => {
        button.addEventListener("mouseover", () => {
            button.style.backgroundColor = "#0056b3"; // Change color on hover
        });
        button.addEventListener("mouseout", () => {
            button.style.backgroundColor = ""; // Reset color
        });
    });

    // Add focus styles for better keyboard navigation
    document.querySelectorAll("a, button").forEach((element) => {
        element.addEventListener("focus", () => {
            element.style.outline = "2px solid #0056b3"; // Add focus outline
        });
        element.addEventListener("blur", () => {
            element.style.outline = ""; // Remove focus outline
        });
    });

    // Ensure carousel is paused on hover for better user control
    const mockupSlider = document.querySelector('#mockupSlider');
    if (mockupSlider) {
        mockupSlider.addEventListener("mouseenter", () => {
            bootstrap.Carousel.getInstance(mockupSlider).pause();
        });
        mockupSlider.addEventListener("mouseleave", () => {
            bootstrap.Carousel.getInstance(mockupSlider).cycle();
        });
    }

    // Initialize the carousel using Bootstrap's JavaScript API
    const bannerCarousel = document.querySelector('#bannerCarousel');
    if (bannerCarousel) {
        const carouselInstance = new bootstrap.Carousel(bannerCarousel, {
            interval: 5000, // Auto-slide every 5 seconds
            ride: 'carousel', // Automatically start the carousel
            pause: 'hover', // Pause on hover
            wrap: true // Enable infinite looping
        });

        // Ensure arrow controls work properly
        const prevButton = bannerCarousel.querySelector('.carousel-control-prev');
        const nextButton = bannerCarousel.querySelector('.carousel-control-next');

        if (prevButton) {
            prevButton.addEventListener('click', () => carouselInstance.prev());
        }
        if (nextButton) {
            nextButton.addEventListener('click', () => carouselInstance.next());
        }
    }
});

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

// Placeholder for future improvements
function futureEnhancements() {
    console.log("This is a placeholder for future functionality.");
}
