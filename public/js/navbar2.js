// === CUSTOM NAVBAR SOLUTION - NO BOOTSTRAP JS ===
document.addEventListener('DOMContentLoaded', function() {
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarCollapse = document.getElementById('navbarNav');
    
    // Navbar toggle function
    navbarToggler.addEventListener('click', function() {
        const isExpanded = navbarCollapse.classList.contains('show');
        
        if (isExpanded) {
            // Close navbar
            navbarCollapse.classList.remove('show');
            navbarToggler.setAttribute('aria-expanded', 'false');
            closeAllDropdowns();
        } else {
            // Open navbar
            navbarCollapse.classList.add('show');
            navbarToggler.setAttribute('aria-expanded', 'true');
        }
    });
    
    // Main dropdown handler
    document.querySelectorAll('.navbar .dropdown > .dropdown-toggle').forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            if (window.innerWidth < 992) {
                e.preventDefault();
                e.stopPropagation();
                
                const dropdown = this.closest('.dropdown');
                const menu = dropdown.querySelector('.dropdown-menu');
                const isOpen = dropdown.classList.contains('show');
                
                // Close all other dropdowns
                closeAllDropdowns();
                
                // Toggle current dropdown
                if (isOpen) {
                    dropdown.classList.remove('show');
                    menu.classList.remove('show');
                } else {
                    dropdown.classList.add('show');
                    menu.classList.add('show');
                }
            }
        });
    });
    
    // Submenu handler
    document.querySelectorAll('.dropdown-submenu > .dropdown-toggle').forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            if (window.innerWidth < 992) {
                e.preventDefault();
                e.stopPropagation();
                
                const submenu = this.closest('.dropdown-submenu');
                const isOpen = submenu.classList.contains('show');
                
                // Toggle submenu
                if (isOpen) {
                    submenu.classList.remove('show');
                } else {
                    // Close other submenus first
                    document.querySelectorAll('.dropdown-submenu.show').forEach(otherSubmenu => {
                        if (otherSubmenu !== submenu) {
                            otherSubmenu.classList.remove('show');
                        }
                    });
                    submenu.classList.add('show');
                }
            }
        });
    });
    
    // Close when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.navbar')) {
            closeAllDropdowns();
        }
    });
    
    function closeAllDropdowns() {
        document.querySelectorAll('.navbar .dropdown.show, .dropdown-submenu.show').forEach(el => {
            el.classList.remove('show');
        });
    }
    
    // Handle resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 992) {
            navbarCollapse.classList.remove('show');
            navbarToggler.setAttribute('aria-expanded', 'false');
            closeAllDropdowns();
        }
    });
});