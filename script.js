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
            navbarToggler.setAttribute("aria-expanded", navbarNav.classList.contains("show"));
        });
    }

    // Add active class to the current navigation link
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
        adjustFooter(); // Adjust footer position on resize
    }));

    // Improve accessibility for keyboard navigation
    navLinks.forEach((link) => {
        link.addEventListener("keydown", (e) => {
            if (e.key === "Enter") {
                link.click(); // Trigger click on Enter key
            }
        });
    });

    // Adjust footer position on window size change
    function adjustFooter() {
        if (window.innerWidth < 768) {
            footer.style.position = "relative"; // Ensure footer is not fixed on small screens
        } else {
            footer.style.position = "fixed"; // Keep footer fixed on larger screens
        }
    }
    adjustFooter(); // Call it initially to set the correct footer position

    // Enhance button interactivity with hover effects
    buttons.forEach(button => {
        button.addEventListener("mouseover", () => {
            button.style.backgroundColor = "#0056b3"; // Change color on hover
        });
        button.addEventListener("mouseout", () => {
            button.style.backgroundColor = ""; // Reset color
        });
    });

    // Focus styles for better keyboard navigation
    document.querySelectorAll("a, button").forEach((element) => {
        element.addEventListener("focus", () => {
            element.style.outline = "2px solid #0056b3"; // Add focus outline
        });
        element.addEventListener("blur", () => {
            element.style.outline = ""; // Remove focus outline
        });
    });

    // Image Upload functionality
    const uploadInput = document.getElementById('image-upload');
    const backgroundContainer = document.getElementById('background-container');
    if (uploadInput) {
        uploadInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const formData = new FormData();
                formData.append('image', file);

                // Send the file to the server using fetch API
                fetch('upload.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.imageUrl) {
                        backgroundContainer.style.backgroundImage = `url(${data.imageUrl})`; // Update background
                    } else {
                        console.error('Error:', data.error);
                    }
                })
                .catch(error => {
                    console.error('Error uploading image:', error);
                });
            }
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

    // Handle image upload preview
    const imageUpload = document.getElementById("image-upload");
    imageUpload.addEventListener("change", (event) => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                backgroundContainer.style.backgroundImage = `url(${e.target.result})`;
                backgroundContainer.style.backgroundSize = "cover";
                backgroundContainer.style.backgroundPosition = "center";
            };
            reader.readAsDataURL(file);
        }
    });

    // Carousel auto-play
    const carousel = document.querySelector("#bannerCarousel");
    if (carousel) {
        new bootstrap.Carousel(carousel, {
            interval: 5000,
            ride: "carousel",
        });
    }
});
