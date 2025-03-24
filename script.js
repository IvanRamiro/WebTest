document.addEventListener("DOMContentLoaded", function () {
    const navbarToggler = document.querySelector(".navbar-toggler");
    const navbarNav = document.querySelector("#navbarNav");
    const footer = document.getElementById("footer");
    const section = document.getElementById("news-events");
    const buttons = document.querySelectorAll(".btn-primary");
    const navLinks = document.querySelectorAll(".nav-link");
    const uploadInput = document.getElementById("image-upload");
    const backgroundContainer = document.getElementById("background-container");
    const bannerCarousel = document.querySelector("#bannerCarousel");
    const uploadForm = document.getElementById("upload-form");
    const fileInput = document.getElementById("file-input");
    const previewImage = document.getElementById("preview-image");
    const statusMessage = document.getElementById("status-message");
    const changeBgBtn = document.getElementById("change-bg-btn");
    const uploadedImage = document.getElementById("uploaded-image");

    /*** Navbar Toggle for Mobile ***/
    if (navbarToggler && navbarNav) {
        navbarToggler.addEventListener("click", () => {
            navbarNav.classList.toggle("show");
            navbarNav.style.transition = "all 0.3s ease-in-out";
            navbarToggler.setAttribute("aria-expanded", navbarNav.classList.contains("show"));
        });
    }

    /*** Highlight Active Navigation Link ***/
    navLinks.forEach((link) => {
        link.addEventListener("click", function () {
            navLinks.forEach((lnk) => lnk.classList.remove("active"));
            this.classList.add("active");
        });
    });

    /*** Accessibility: Allow Enter Key to Trigger Click on Nav Links ***/
    navLinks.forEach((link) => {
        link.addEventListener("keydown", (e) => {
            if (e.key === "Enter") link.click();
        });
    });
    navLinks.forEach((link) => {
        link.addEventListener("click", function () {
            // Remove active class from all links
            navLinks.forEach((nav) => nav.classList.remove("active"));

            // Add active class to the clicked link
            this.classList.add("active");
        });
    });
});
    /*** Footer Position Adjustment ***/
    function adjustFooter() {
        footer.style.position = window.innerWidth < 768 ? "relative" : "fixed";
    }
    adjustFooter();
    window.addEventListener("resize", debounce(adjustFooter));

    /*** Button Hover Effects ***/
    buttons.forEach(button => {
        button.addEventListener("mouseover", () => button.classList.add("hover-effect"));
        button.addEventListener("mouseout", () => button.classList.remove("hover-effect"));
    });

    /*** Image Upload for Hero Background ***/
    if (uploadInput) {
        uploadInput.addEventListener("change", function (event) {
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
    }

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
                    statusMessage.innerHTML = data.error;
                    statusMessage.style.color = "red";
                } else {
                    const uploadedUrl = data.imageUrl;
                    statusMessage.innerHTML = "Background updated!";
                    statusMessage.style.color = "green";
                    
                    // Apply the background
                    backgroundContainer.style.backgroundImage = `url(${uploadedUrl})`;
                    backgroundContainer.style.backgroundSize = "cover";
                    backgroundContainer.style.backgroundPosition = "center";
            
                    // Show preview image
                    uploadedImage.src = uploadedUrl;
                    uploadedImage.style.display = "block";
                    changeBgBtn.style.display = "block"; // Ensure button remains visible
            
                    // Save to local storage
                    localStorage.setItem("bgImage", uploadedUrl);
                }
            })
            .catch(() => {
                statusMessage.innerHTML = "An error occurred.";
                statusMessage.style.color = "red";
            });
        });            

    uploadInput.addEventListener("change", function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImage.src = e.target.result;
                previewImage.style.display = "block";
                changeBgBtn.style.display = "block"; // Ensure button appears
            };
            reader.readAsDataURL(file);
        }
    });
    
    /*** Upload Image via AJAX ***/
    uploadForm.addEventListener("submit", function (event) {
        event.preventDefault();
        let formData = new FormData(uploadForm);

        fetch("upload.php", {
            method: "POST",
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                statusMessage.innerHTML = data.error;
                statusMessage.style.color = "red";
            } else {
                statusMessage.innerHTML = "Background updated!";
                statusMessage.style.color = "green";
                backgroundContainer.style.backgroundImage = `url(${data.imageUrl})`;
                localStorage.setItem("bgImage", data.imageUrl); // Save to local storage
            }
        })
        .catch(() => {
            statusMessage.innerHTML = "An error occurred.";
            statusMessage.style.color = "red";
        });
    });

    /*** Change Background ***/
    changeBgBtn.addEventListener("click", function () {
        uploadInput.click();
    });

    /*** Load Background from Storage ***/
    const savedImage = localStorage.getItem("bgImage");
    if (savedImage) {
        backgroundContainer.style.backgroundImage = `url(${savedImage})`;
    }

    /*** Scroll Reveal Effect for News Section ***/
    function revealOnScroll() {
        if (!section) return;
        if (section.getBoundingClientRect().top < window.innerHeight - 100) {
            section.classList.add("show");
        }
    }

    /*** Footer Visibility on Scroll ***/
    function toggleFooter() {
        if (window.scrollY > 500) {
            footer.classList.add("show-footer");
        } else {
            footer.classList.remove("show-footer");
        }
    }

    /*** Debounce Function for Scroll Events ***/
    function debounce(func, wait = 20) {
        let timeout;
        return function (...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }

    /*** Attach Scroll Event Listeners ***/
    window.addEventListener("scroll", debounce(() => {
        revealOnScroll();
        toggleFooter();
    }));

    /*** Smooth Scrolling for Internal Links ***/
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener("click", function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute("href"));
            if (target) {
                target.scrollIntoView({ behavior: "smooth" });
            }
        });
    });

    /*** Initialize Bootstrap Carousel ***/
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
    };
    };
