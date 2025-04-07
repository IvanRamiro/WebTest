document.addEventListener("DOMContentLoaded", function () {
    const navbarToggler = document.querySelector(".navbar-toggler");
    const navbarNav = document.querySelector("#navbarNav");
    if (navbarToggler && navbarNav) {
        navbarToggler.addEventListener("click", () => {
            navbarNav.classList.toggle("show");
            navbarToggler.setAttribute("aria-expanded", navbarNav.classList.contains("show"));
        });
    }

    const navLinks = document.querySelectorAll(".nav-link");
    navLinks.forEach(link => {
        link.addEventListener("click", function () {
            navLinks.forEach(lnk => lnk.classList.remove("active"));
            this.classList.add("active");
        });
    });

    navLinks.forEach(link => {
        link.addEventListener("keydown", e => {
            if (e.key === "Enter") link.click();
        });
    });

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener("click", function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute("href"));
            if (target) {
                target.scrollIntoView({ behavior: "smooth" });
            }
        });
    });

    const footer = document.getElementById("footer");
    function adjustFooter() {
        if (footer) {
            footer.style.position = window.innerWidth < 768 ? "relative" : "fixed";
        }
    }
    adjustFooter();
    window.addEventListener("resize", debounce(adjustFooter, 100));

    function toggleFooter() {
        if (footer) {
            footer.classList.toggle("show-footer", window.scrollY > 500);
        }
    }

    document.querySelectorAll(".btn-primary").forEach(button => {
        button.addEventListener("mouseover", () => button.classList.add("hover-effect"));
        button.addEventListener("mouseout", () => button.classList.remove("hover-effect"));
    });

    const section = document.getElementById("news-events");
    function revealOnScroll() {
        if (section && section.getBoundingClientRect().top < window.innerHeight - 100) {
            section.classList.add("show");
        }
    }

    function debounce(func, wait = 20) {
        let timeout;
        return function (...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }

    window.addEventListener("scroll", debounce(() => {
        revealOnScroll();
        toggleFooter();
    }, 100));

    const addEventButton = document.querySelector(".btn-outline-danger");
    if (addEventButton) {
        addEventButton.addEventListener("click", addEvent);
    }

    document.getElementById('helpTicketForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Here you would typically send the form data to your server
        // For demonstration, we'll just show an alert
        alert('Thank you for submitting your help ticket. Our team will get back to you soon.');
        
        // Close the modal
        var modal = bootstrap.Modal.getInstance(document.getElementById('helpTicketModal'));
        modal.hide();
        
        // Reset the form
        this.reset();
    });
});