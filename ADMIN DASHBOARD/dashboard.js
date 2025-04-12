// DOM Elements
const toggle = document.querySelector('.toggle');
const navigation = document.querySelector('.navigation');
const main = document.querySelector('.main');
const themeToggle = document.querySelector('#theme-toggle');
const overlay = document.createElement('div');

// Initialize overlay
overlay.classList.add('nav-overlay');
document.body.appendChild(overlay);

// Event Listeners
document.addEventListener('DOMContentLoaded', function() {
    // Initialize saved theme
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        document.body.classList.add('dark');
    }
    
    // Set active navigation item
    setActiveNavItem();
    
    // Attach delete event to dynamically loaded buttons
    document.querySelectorAll('.deleteBtn').forEach(button => {
        button.addEventListener('click', function() {
            const itemId = this.getAttribute('data-id');
            deleteItem(itemId);
        });
    });
});

// Sidebar Toggle Functionality
toggle.onclick = function() {
    navigation.classList.toggle('active');
    main.classList.toggle('active');
    overlay.classList.toggle('active');
};

// Overlay Click Handler
overlay.onclick = function() {
    navigation.classList.remove('active');
    main.classList.remove('active');
    overlay.classList.remove('active');
};

// Navigation Active State Functionality
function setActiveNavItem() {
    const navItems = document.querySelectorAll('.navigation li:not(.logo)');
    const currentPage = window.location.pathname.split('/').pop();
    
    navItems.forEach(item => {
        const link = item.querySelector('a');
        const itemPage = link.getAttribute('href');
        
        // Set active class if this is the current page
        if (itemPage === currentPage) {
            item.classList.add('active');
            // Store the active item
            localStorage.setItem('activeNavItem', itemPage);
        }
        
        // Click event handler
        item.addEventListener('click', function(e) {
            // Don't interfere with default link behavior
            if (e.target.tagName === 'A') return;
            
            // Remove active class from all items
            navItems.forEach(navItem => {
                navItem.classList.remove('active');
            });
            
            // Add active class to clicked item
            this.classList.add('active');
            
            // Store the active item
            localStorage.setItem('activeNavItem', itemPage);
        });
    });
    
    // Check for stored active item if no current page match
    if (!document.querySelector('.navigation li.active')) {
        const storedActiveItem = localStorage.getItem('activeNavItem');
        if (storedActiveItem) {
            navItems.forEach(item => {
                if (item.querySelector('a').getAttribute('href') === storedActiveItem) {
                    item.classList.add('active');
                }
            });
        }
    }
}

// Dark Mode Toggle
themeToggle?.addEventListener('click', () => {
    document.body.classList.toggle('dark');
    localStorage.setItem('theme', document.body.classList.contains('dark') ? 'dark' : 'light');
});