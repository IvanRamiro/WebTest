document.addEventListener("DOMContentLoaded", function () {
    // ✅ Navbar Toggle for Mobile
    const navbarToggler = document.querySelector(".navbar-toggler");
    const navbarNav = document.querySelector("#navbarNav");
    if (navbarToggler && navbarNav) {
        navbarToggler.addEventListener("click", () => {
            navbarNav.classList.toggle("show");
            navbarToggler.setAttribute("aria-expanded", navbarNav.classList.contains("show"));
        });
    }

    // ✅ Highlight Active Navigation Link
    const navLinks = document.querySelectorAll(".nav-link");
    navLinks.forEach(link => {
        link.addEventListener("click", function () {
            navLinks.forEach(lnk => lnk.classList.remove("active"));
            this.classList.add("active");
        });
    });

    // ✅ Allow Enter Key to Trigger Click on Nav Links
    navLinks.forEach(link => {
        link.addEventListener("keydown", e => {
            if (e.key === "Enter") link.click();
        });
    });

    // ✅ Footer Position Adjustment
    const footer = document.getElementById("footer");
    function adjustFooter() {
        if (footer) {
            footer.style.position = window.innerWidth < 768 ? "relative" : "fixed";
        }
    }
    adjustFooter();
    window.addEventListener("resize", debounce(adjustFooter, 100));

    // ✅ Button Hover Effects
    document.querySelectorAll(".btn-primary").forEach(button => {
        button.addEventListener("mouseover", () => button.classList.add("hover-effect"));
        button.addEventListener("mouseout", () => button.classList.remove("hover-effect"));
    });

    // ✅ Image Upload for Hero Background
    const uploadInput = document.getElementById("image-upload");
    const backgroundContainer = document.getElementById("background-container");
    if (uploadInput && backgroundContainer) {
        uploadInput.addEventListener("change", function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => {
                    backgroundContainer.style.backgroundImage = `url(${e.target.result})`;
                    backgroundContainer.style.backgroundSize = "cover";
                    backgroundContainer.style.backgroundPosition = "center";
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // ✅ Upload Form Submission
    const uploadForm = document.getElementById("upload-form");
    const statusMessage = document.getElementById("status-message");
    const uploadedImage = document.getElementById("uploaded-image");
    const changeBgBtn = document.getElementById("change-bg-btn");

    if (uploadForm) {
        uploadForm.addEventListener("submit", function (event) {
            event.preventDefault();
            if (uploadInput.files.length === 0) {
                alert("Please select an image before uploading.");
                return;
            }

            let formData = new FormData();
            formData.append("background-image", uploadInput.files[0]);

            fetch("upload.php", {
                method: "POST",
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    statusMessage.textContent = data.error;
                    statusMessage.style.color = "red";
                } else {
                    const uploadedUrl = data.imageUrl;
                    statusMessage.textContent = "Background updated!";
                    statusMessage.style.color = "green";
                    backgroundContainer.style.backgroundImage = `url(${uploadedUrl})`;
                    uploadedImage.src = uploadedUrl;
                    uploadedImage.style.display = "block";
                    changeBgBtn.style.display = "block";
                    localStorage.setItem("bgImage", uploadedUrl);
                }
            })
            .catch(() => {
                statusMessage.textContent = "An error occurred.";
                statusMessage.style.color = "red";
            });
        });
    }

    // ✅ Load Background from Local Storage
    const savedImage = localStorage.getItem("bgImage");
    if (savedImage && backgroundContainer) {
        backgroundContainer.style.backgroundImage = `url(${savedImage})`;
    }

    // ✅ Scroll Reveal Effect for News Section
    const section = document.getElementById("news-events");
    function revealOnScroll() {
        if (section && section.getBoundingClientRect().top < window.innerHeight - 100) {
            section.classList.add("show");
        }
    }

    // ✅ Footer Visibility on Scroll
    function toggleFooter() {
        if (footer) {
            footer.classList.toggle("show-footer", window.scrollY > 500);
        }
    }

    // ✅ Debounce Function for Scroll Events
    function debounce(func, wait = 20) {
        let timeout;
        return function (...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }

    // ✅ Attach Scroll Event Listeners
    window.addEventListener("scroll", debounce(() => {
        revealOnScroll();
        toggleFooter();
    }, 100));

    // ✅ Smooth Scrolling for Internal Links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener("click", function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute("href"));
            if (target) {
                target.scrollIntoView({ behavior: "smooth" });
            }
        });
    });

    // ✅ Initialize Bootstrap Carousel
    const bannerCarousel = document.querySelector("#bannerCarousel");
    if (bannerCarousel) {
        const carouselInstance = new bootstrap.Carousel(bannerCarousel, {
            interval: 5000,
            ride: "carousel",
            pause: "hover",
            wrap: true
        });

        const prevButton = bannerCarousel.querySelector(".carousel-control-prev");
        const nextButton = bannerCarousel.querySelector(".carousel-control-next");

        if (prevButton) prevButton.addEventListener("click", () => carouselInstance.prev());
        if (nextButton) nextButton.addEventListener("click", () => carouselInstance.next());
    }

    // ✅ Custom Carousel Functionality
    let images = document.querySelectorAll(".carousel-images img");
    let currentIndex = 0;

    function showImage(index) {
        if (images.length > 0) {
            images.forEach((img, i) => {
                img.classList.toggle("active", i === index);
            });
        }
    }

    const nextBtn = document.querySelector(".next");
    const prevBtn = document.querySelector(".prev");

    if (nextBtn && prevBtn) {
        nextBtn.addEventListener("click", function () {
            currentIndex = (currentIndex + 1) % images.length;
            showImage(currentIndex);
        });

        prevBtn.addEventListener("click", function () {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            showImage(currentIndex);
        });

        // Initialize with the first image displayed
        showImage(currentIndex);
    }

    // Function to dynamically add a new event card
    function addEvent() {
        const row = document.querySelector(".news-section .row");
        if (row) {
            const newCard = document.createElement("div");
            newCard.className = "col-12 col-sm-6 col-md-4 col-lg-3";
            newCard.innerHTML = `
                <div class="card h-100">
                    <img src="Images/DefaultCat.jpg" class="card-img-top" alt="New Event">
                    <div class="card-body">
                        <h5 class="card-title">New Event</h5>
                        <p class="card-text">Description of the new event...</p>
                        <a href="#" class="btn btn-danger">Read More</a>
                    </div>
                </div>
            `;
            row.insertBefore(newCard, row.lastElementChild);
        }
    }

    // Ensure the "Add Event" button is functional
    const addEventButton = document.querySelector(".btn-outline-danger");
    if (addEventButton) {
        addEventButton.addEventListener("click", addEvent);
    }

    // Smooth Scroll for "Find Us" Section
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener("click", function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute("href"));
            if (target) {
                target.scrollIntoView({ behavior: "smooth" });
            }
        });
    });

    // Form Submission Handler
    document.querySelector(".stay-connected form").addEventListener("submit", function (e) {
        e.preventDefault();
        alert("Thank you for reaching out! We will get back to you soon.");
    });

    // Animation for "Find Us" Icons
    const findUsIcons = document.querySelectorAll(".find-us i");
    findUsIcons.forEach(icon => {
        icon.addEventListener("mouseover", () => icon.classList.add("fa-bounce"));
        icon.addEventListener("mouseout", () => icon.classList.remove("fa-bounce"));
    });

    // Contact Form Submission Handler
    const contactForm = document.getElementById("contactForm");
    if (contactForm) {
        contactForm.addEventListener("submit", function (e) {
            e.preventDefault();
            alert("Thank you for your message! We will get back to you shortly.");
            contactForm.reset();    
        });
    }

    // Smooth scroll to "Our Departments" section
    const departmentsLink = document.querySelector('a[href="#departments"]');
    if (departmentsLink) {
        departmentsLink.addEventListener("click", function (e) {
            e.preventDefault();
            const target = document.querySelector(".departments-section");
            if (target) {
                target.scrollIntoView({ behavior: "smooth" });
            }
        });
    }

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Toggle navbar on smaller screens
    const navbarCollapse = document.querySelector('#navbarNav');

    navbarToggler.addEventListener('click', () => {
        navbarCollapse.classList.toggle('show');
    });

    // Form validation
    document.getElementById('contactForm').addEventListener('submit', function (e) {
        const fullName = document.getElementById('fullName').value.trim();
        const email = document.getElementById('email').value.trim();
        const contactNumber = document.getElementById('contactNumber').value.trim();

        if (!fullName || !email || !contactNumber) {
            e.preventDefault();
            alert('Please fill out all required fields.');
        }
    });
});
