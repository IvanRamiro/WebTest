// DOM Elements
const toggle = document.querySelector('.toggle');
const navigation = document.querySelector('.navigation');
const main = document.querySelector('.main');
const themeToggle = document.querySelector('#theme-toggle');
const overlay = document.createElement('div');

overlay.classList.add('nav-overlay');
document.body.appendChild(overlay);

document.addEventListener('DOMContentLoaded', function() {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        document.body.classList.add('dark');
    }
    
    setActiveNavItem();
    
    document.querySelectorAll('.deleteBtn').forEach(button => {
        button.addEventListener('click', function() {
            const itemId = this.getAttribute('data-id');
            deleteItem(itemId);
        });
    });
});

toggle.onclick = function() {
    navigation.classList.toggle('active');
    main.classList.toggle('active');
    overlay.classList.toggle('active');
};

overlay.onclick = function() {
    navigation.classList.remove('active');
    main.classList.remove('active');
    overlay.classList.remove('active');
};

function setActiveNavItem() {
    const navItems = document.querySelectorAll('.navigation li:not(.logo)');
    const currentPage = window.location.pathname.split('/').pop();
    
    navItems.forEach(item => {
        const link = item.querySelector('a');
        const itemPage = link.getAttribute('href');
        
        if (itemPage === currentPage) {
            item.classList.add('active');
            localStorage.setItem('activeNavItem', itemPage);
        }
        
        item.addEventListener('click', function(e) {
            if (e.target.tagName === 'A') return;
            
            navItems.forEach(navItem => {
                navItem.classList.remove('active');
            });
            
            this.classList.add('active');
            
            localStorage.setItem('activeNavItem', itemPage);
        });
    });
    
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

