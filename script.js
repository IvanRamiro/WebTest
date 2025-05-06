document.addEventListener("DOMContentLoaded", function () {
    // Mobile navbar toggler functionality
    const navbarToggler = document.querySelector(".navbar-toggler");
    const navbarNav = document.querySelector("#navbarNav");
    if (navbarToggler && navbarNav) {
        navbarToggler.addEventListener("click", () => {
            navbarNav.classList.toggle("show");
            navbarToggler.setAttribute("aria-expanded", navbarNav.classList.contains("show"));
        });
    }

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener("click", function (e) {
            // Skip if link is for a modal or has a special class
            if (this.classList.contains('no-smooth-scroll') || 
                this.getAttribute('data-bs-toggle') === 'modal') {
                return;
            }
            
            e.preventDefault();
            const target = document.querySelector(this.getAttribute("href"));
            if (target) {
                target.scrollIntoView({ 
                    behavior: "smooth",
                    block: "start"
                });
            }
        });
    });

    // Footer positioning adjustment
    const footer = document.getElementById("footer");
    function adjustFooter() {
        if (footer) {
            footer.style.position = window.innerWidth < 768 ? "relative" : "fixed";
        }
    }
    adjustFooter();
    window.addEventListener("resize", debounce(adjustFooter, 100));

    // Button hover effects
    document.querySelectorAll(".btn-primary").forEach(button => {
        button.addEventListener("mouseover", () => button.classList.add("hover-effect"));
        button.addEventListener("mouseout", () => button.classList.remove("hover-effect"));
    });

    // Scroll reveal for news section
    const section = document.getElementById("news-events");
    function revealOnScroll() {
        if (section && section.getBoundingClientRect().top < window.innerHeight - 100) {
            section.classList.add("show");
        }
    }

    // Number counter animation
    const counters = document.querySelectorAll('[data-target]');
    const startCounters = () => {
        counters.forEach(counter => {
            const updateCount = () => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const increment = target / 200;

                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(updateCount, 10);
                } else {
                    counter.innerText = target;
                }
            };
            updateCount();
        });
    };

    // Intersection Observer for counters
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                startCounters();
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    if (counters.length > 0) {
        const numberSpeakSection = document.getElementById('number-speak');
        if (numberSpeakSection) {
            observer.observe(numberSpeakSection);
        }
    }

    // Help ticket form submission
    const helpTicketForm = document.getElementById('helpTicketForm');
    if (helpTicketForm) {
        helpTicketForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Here you would typically send the form data to your server
            // For demonstration, we'll just show an alert
            alert('Thank you for submitting your help ticket. Our team will get back to you soon.');
            
            // Close the modal
            var modal = bootstrap.Modal.getInstance(document.getElementById('helpTicketModal'));
            if (modal) {
                modal.hide();
            }
            
            // Reset the form
            this.reset();
        });
    }

    // Debounce function for performance
    function debounce(func, wait = 20) {
        let timeout;
        return function (...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }

    // Scroll event listeners
    window.addEventListener("scroll", debounce(() => {
        revealOnScroll();
    }, 100));
});