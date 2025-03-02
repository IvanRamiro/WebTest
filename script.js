document.addEventListener("DOMContentLoaded", function () {
    // Navbar Toggler (for mobile menu)
    const navbarToggler = document.querySelector(".navbar-toggler");
    const navbarNav = document.querySelector("#navbarNav");
    const footer = document.getElementById("footer");
    const section = document.getElementById("news-events");

    if (navbarToggler && navbarNav) {
        navbarToggler.addEventListener("click", function () {
            navbarNav.classList.toggle("show");
        });
    }

    // Scroll Reveal Effect for News Section
    function revealOnScroll() {
        if (!section) return; // Prevents errors if section doesn't exist

        const sectionTop = section.getBoundingClientRect().top;
        const windowHeight = window.innerHeight;

        if (sectionTop < windowHeight - 100) {
            section.classList.add("show");
        }
    }

    // Footer Reveal on Scroll
    function toggleFooter() {
        if (window.scrollY > 500) { // Adjust scroll value as needed
            footer.classList.add("show-footer");
        } else {
            footer.classList.remove("show-footer");
        }
    }

    // Attach scroll event listeners
    window.addEventListener("scroll", revealOnScroll);
    window.addEventListener("scroll", toggleFooter);

    // Button Click Alert (Future Feature)
    const buttons = document.querySelectorAll(".btn-primary");
    buttons.forEach(button => {
        button.addEventListener("click", function () {
            alert("Feature coming soon!");
        });
    });
});
