// Detect when the navbar is collapsed
function isNavbarCollapsed() {
    return window.innerWidth < 992; // Bootstrap's lg breakpoint
    //return window.getComputedStyle(document.querySelector('.navbar-toggler')).display !== 'none';
}

// Toggle Sub-menu on Click
document.querySelectorAll(".dropdown-submenu > a").forEach(function (submenuLink) {
    submenuLink.addEventListener('click', function (e) {
        if (isNavbarCollapsed()) { // Only in mobile view
            e.preventDefault();
            e.stopPropagation(); // Prevent parent dropdown from closing

            const parentSubmenu = this.parentElement;
            const isCurrentlyOpen = parentSubmenu.classList.contains("show");

            // If clicking the same submenu that's already open, close it
            if(isCurrentlyOpen) {
                parentSubmenu.classList.remove("show");
            } else {
                // Close other open submenus
                document.querySelectorAll(".dropdown-submenu.show").forEach(function (openSubmenu) {
                    if(openSubmenu !== parentSubmenu) {
                        openSubmenu.classList.remove("show");
                    }
                });

                // Open the current submenu
                parentSubmenu.classList.add("show");
            }
        }
    });
});

// Close all submenus if clicked elsewhere
document.addEventListener('click', function() {
    document.querySelectorAll('dropdown-submenu').foreach(function (submenu) {
        submenu.classList.remove("show");
    });
});

// Hover effect for desktop only
function setupHoverEffects() {
    // Remove all existing hover events first
    document.querySelectorAll(".navbar .dropdown, .dropdown-submenu").forEach(function (element) {
        // Clone and replace to remove event listeners
        const newElement = element.cloneNode(true);
        element.parentNode.replaceChild(newElement, element);
    });
    
    if (window.innerWidth > 900) { // Desktop only
        document.querySelectorAll(".navbar .dropdown, .dropdown-submenu").forEach(function (element) {
            element.addEventListener('mouseover', function () {
                this.classList.add("show");
                const menu = this.querySelector(".dropdown-menu");
                if (menu) menu.classList.add("show");
            });
            element.addEventListener('mouseout', function () {
                this.classList.remove("show");
                const menu = this.querySelector(".dropdown-menu");
                if (menu) menu.classList.remove("show");
            });
        });
    }
}

// Initialize hover effects and re-initialize on resize
setupHoverEffects();
window.addEventListener('resize', setupHoverEffects);

// === FIX THE TOGGLE BEHAVIOUR ===
// == 1 - Recently there's a problem when disabling the toggle navbar, when implementing in this shidokan web ==

// Handle click events for dropdown links in mobile view
document.querySelectorAll(".navbar .dropdown > a").forEach(function (dropdownLink) {
    dropdownLink.addEventListener('click', function (e) {
        if (isNavbarCollapsed()) { // Only handle clicks for mobile screens
            e.preventDefault(); // Prevent default link behavior
            
            const parentDropdown = this.parentElement;
            const dropdownMenu = parentDropdown.querySelector(".dropdown-menu");
            const isCurrentlyOpen = parentDropdown.classList.contains("show");

            // If clicking the same dropdown that's already open, close it
            if(isCurrentlyOpen) {
                parentDropdown.classList.remove("show");
                dropdownMenu.classList.remove("show");
            } else {
                // Close any open dropdowns except the current one
                document.querySelectorAll(".navbar .dropdown.show").forEach(function (openDropdown) {
                    if(openDropdown !== parentDropdown) {
                        openDropdown.classList.remove("show");
                        openDropdown.querySelector(".dropdown-menu").classList.remove("show");
                    }
                });
            }

            // Open the current dropdown menu
            parentDropdown.classList.add("show");
            dropdownMenu.classList.add("show");
        }
    });
});

// Handle navbar toggle button click
document.querySelector(".navbar-toggler").addEventListener('click', function() {
    const navbarCollapse = document.querySelector('#navbarNav');
    const isExpanded = navbarCollapse.classList.contains('show');

    // Update aria-expanded attribute
    this.setAttribute('aria-expanded', isExpanded);
    console.log('Navbar toggled. Current state:', isExpanded);
});

// Initialize Bootstrap's collapse component with custom toggle behavior
const myCollapse = new bootstrap.Collapse(document.querySelector('#navbarNav'), {
    toggle: false, // Prevent automatic toggling by Bootstrap
});

// To make the Toggle Functions (Eventhough no dropdown toggle animation)
document.querySelector('.navbar-toggler').addEventListener('click', function() {
    const navbarCollapse = document.querySelector('#navbarNav');
    const isExpanded = navbarCollapse.classList.toggle('show');

    this.setAttribute('aria-expanded', isExpanded);
    console.log('Navbar toggled. Current state:', isExpanded);
});

// == 2 - reset dropdown menus ==
/* Outmostly when after clicking a main-menu dropdown in mobile view, then resize it to laptop/pc view
 and then the dropdown of the sub-menu permanently stays there */

// Function to reset dropdown menus
function resetDropdowns() {
    // Remove 'show' class from all dropdowns by creating const dropdownMenu inside func params
    document.querySelectorAll(".navbar .dropdown-menu").forEach(function (dropdownMenu) {
        dropdownMenu.classList.remove('show');
    });

    document.querySelectorAll(".navbar .dropdown").forEach(function (dropdown) {
        dropdown.classList.remove('show');
    });
}

// Add a resize event listener to handle viewport changes
window.addEventListener("resize", function () {
    if(window.innerWidth > 900) { // Adjust the width to match your breakpoint
        resetDropdowns();
    }
});

// Handle click for mobile screens needed (added in below this, on ==ANIMATIONS== Part #2)

// Handle click for mobile screens (main and sub-sub-menus)
document.querySelectorAll(".navbar .dropdown > a").forEach(function (dropdownLink) {
    dropdownLink.addEventListener('click', function (e) {
        if (window.innerWidth <= 900) { // Only handle clicks for mobile screens
            e.preventDefault();
            const parentDropdown = this.parentElement;

            // Toggle the dropdown menu
            const dropdownMenu = parentDropdown.querySelector(".dropdown-menu");
            //const isOpen = dropdownMenu.classList.contains("show");

            // Close any open dropdowns except the current one
            /*document.querySelectorAll(".navbar .dropdown.show").forEach(function (openDropdown) {
                if (openDropdown !== parentDropdown) {
                    openDropdown.classList.remove("show");
                    openDropdown.querySelector(".dropdown-menu").classList.remove("show");
                }
            });*/

            // Close the previous dropdowns by clicking the same previous dropdown (giving hide dropdown)
            if(parentDropdown.classList.contains("show")) {
                // If the current dropdown is open, close it
                parentDropdown.classList.remove("show");
                dropdownMenu.classList.remove("show");
            } else {
                // Close any other open dropdowns
                document.querySelectorAll(".navbar .dropdown.show").forEach(function (openDropdown) {
                    openDropdown.classList.remove("show");
                    openDropdown.querySelector(".dropdown-menu").classList.remove("show");
                });
            }

            // Toggle the current dropdown menu
            dropdownMenu.classList.toggle("show", !isOpen);
            parentDropdown.classList.toggle("show", !isOpen);
        }
    });
});

// Automatically close dropdowns when clicking outside the navbar (optional but recommended)
document.addEventListener("click", function (e) {
    const isClickInsideNavbar = e.target.closest(".navbar");

    if (!isClickInsideNavbar && window.innerWidth <= 900) {
        resetDropdowns();
    }
});

// Handle hover for sub-sub-menus in desktop view
document.querySelectorAll(".dropdown-submenu").forEach(function (submenu) {
    submenu.addEventListener("mouseover", function () {
        this.classList.add("show");
        this.querySelector(".dropdown-menu").classList.add("show");
    });
    submenu.addEventListener("mouseout", function () {
        this.classList.remove("show");
        this.querySelector(".dropdown-menu").classList.remove("show");
    });
});

// Handle hover for main menu items in desktop view
document.querySelectorAll(".navbar .dropdown").forEach(function (dropdown) {
    dropdown.addEventListener("mouseover", function () {
        if (window.innerWidth > 900) {
            this.classList.add("show");
            this.querySelector(".dropdown-menu").classList.add("show");
        }
    });
    dropdown.addEventListener("mouseout", function () {
        if (window.innerWidth > 900) {
            this.classList.remove("show");
            this.querySelector(".dropdown-menu").classList.remove("show");
        }
    });
});

// === ANIMATIONS ===

// Handle click for mobile screens #1
/*document.querySelectorAll(".navbar .dropdown > a").forEach(function (dropdownLink) {
    dropdownLink.addEventListener('click', function (e) {
        if (isNavbarCollapsed()) { // Only handle clicks in toggle mode (for mobile screen outmost)
            e.preventDefault(); // Prevent default link behavior

            const parentDropdown = this.parentElement;
            const dropdownMenu = parentDropdown.querySelector(".dropdown-menu");
            const isVisible = dropdownMenu.classList.contains("show");

            //toggleDropdownAnimation(parentDropdown, isVisible);

            // Close all open dropdowns except the current one
            document.querySelectorAll(".navbar .dropdown .dropdown-menu.show").forEach(function (openMenu) {
                if (openMenu !== dropdownMenu) {
                    openMenu.classList.remove("show");
                    openMenu.style.display = "none";
                }
            });

            // Toggle the clicked dropdown menu
            if(isVisible) {
                // If submenu is already visible, hide it
                dropdownMenu.classList.remove("show");
                dropdownMenu.style.display = "none"; // Hide with inline styles
            } else {
                // show the clicked sub-menu
                dropdownMenu.classList.add("show");
                dropdownMenu.style.display = "block";

                // Close any other open submenus
                document.querySelectorAll(".navbar .dropdown .dropdown-menu.show").forEach(function (openMenu) {
                    if (openMenu !== dropdownMenu) {
                        openMenu.classList.remove("show");
                        openMenu.style.display = "none";
                    }
                });
            }

            // Close other open dropdowns
            document.querySelectorAll(".navbar .dropdown.show").forEach(function (openDropdown) {
                if (openDropdown !== parentDropdown) {
                    openDropdown.classList.remove("show");
                    toggleDropdownAnimation(openDropdown, false);
                }
            });
        }
    });
}); */

// Handle click for mobile screens #2
/*document.querySelectorAll(".navbar .dropdown > a").forEach(function (dropdownLink) {
    dropdownLink.addEventListener('click', function (e) {
        if (window.innerWidth <= 900) { // Only handle clicks for mobile screens
            e.preventDefault();
            const parentDropdown = this.parentElement;

            // Toggle the dropdown menu
            const dropdownMenu = parentDropdown.querySelector(".dropdown-menu");
            const isOpen = dropdownMenu.classList.contains("show");

            // Close any open dropdowns except the current one
            document.querySelectorAll(".navbar .dropdown.show").forEach(function (openDropdown) {
                if (openDropdown !== parentDropdown) {
                    openDropdown.classList.remove("show");
                    openDropdown.querySelector(".dropdown-menu").classList.remove("show");
                }
            });

            // Toggle the current dropdown menu
            dropdownMenu.classList.toggle("show", !isOpen);
            parentDropdown.classList.toggle("show", !isOpen);
        }
    });
});*/

// Handle main dropdown menus for mobile view
document.querySelectorAll(".navbar .dropdown > a").forEach(function (dropdownLink) {
    dropdownLink.addEventListener("click", function (e) {
        if (window.innerWidth < 900) {
            e.preventDefault();

            const parentDropdown = this.parentElement;
            const dropdownMenu = this.nextElementSibling;
            const isOpen = parentDropdown.classList.contains("show");

            // Close all other open dropdowns
            document.querySelectorAll(".navbar .dropdown.show").forEach(function (openDropdown) {
                if (openDropdown !== parentDropdown) {
                    openDropdown.classList.remove("show");
                    openDropdown.querySelectorAll(".dropdown-menu.show, .dropdown-submenu-menu.show").forEach(function (menu) {
                        menu.classList.remove("show");
                    });
                }
            });

            // Toggle the current dropdown menu
            dropdownMenu.classList.toggle("show", !isOpen);
            parentDropdown.classList.toggle("show", !isOpen);
        }
    });
});


// Function to check if the navbar is in toggle mode
function isNavbarCollapsed() {
    return window.innerWidth < 992; // Adjust breakpoint as per your design
}