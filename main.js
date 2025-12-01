// Navigation
document.addEventListener('DOMContentLoaded', function() {
    initializeNavigation();
    initializeModal();
    initializeSidebar();
});

// Initialize Navigation
function initializeNavigation() {
    const navItems = document.querySelectorAll('.nav-item[data-page]');
    const pages = document.querySelectorAll('.page');
    const pageTitle = document.getElementById('pageTitle');

    navItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all nav items
            navItems.forEach(nav => nav.classList.remove('active'));
            
            // Add active class to clicked item
            this.classList.add('active');
            
            // Get page to show
            const pageId = this.getAttribute('data-page');
            
            // Hide all pages
            pages.forEach(page => page.style.display = 'none');
            
            // Show selected page
            const selectedPage = document.getElementById(pageId + '-page');
            if (selectedPage) {
                selectedPage.style.display = 'block';
            }
            
            // Update page title
            const pageText = this.querySelector('span:last-child').textContent;
            pageTitle.textContent = pageText;
        });
    });
}

// Initialize Sidebar Toggle
function initializeSidebar() {
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');

    if (menuToggle) {
        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });
    }

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 768) {
            if (!sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
                sidebar.classList.remove('active');
            }
        }
    });
}

// Modal Functions
function initializeModal() {
    const modal = document.getElementById('modal');
    
    // Close modal when clicking outside
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });
}

function openModal(type) {
    const modal = document.getElementById('modal');
    const modalTitle = document.getElementById('modalTitle');
    
    // Set modal title based on type
    switch(type) {
        case 'add-course':
            modalTitle.textContent = 'Ajouter un cours';
            break;
        case 'edit-course':
            modalTitle.textContent = 'Modifier le cours';
            break;
        case 'add-equipment':
            modalTitle.textContent = 'Ajouter un équipement';
            break;
        case 'edit-equipment':
            modalTitle.textContent = 'Modifier l\'équipement';
            break;
        case 'add-association':
            modalTitle.textContent = 'Créer une association';
            break;
        case 'manage-association':
            modalTitle.textContent = 'Gérer l\'association';
            break;
        default:
            modalTitle.textContent = 'Modal';
    }
    
    modal.classList.add('active');
}

function closeModal() {
    const modal = document.getElementById('modal');
    modal.classList.remove('active');
}

// Delete Confirmation
function confirmDelete() {
    if (confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')) {
        // Add your delete logic here
        alert('Élément supprimé avec succès!');
        // You would typically make an AJAX call to your PHP backend here
    }
}

// Search functionality (to be connected to backend)
document.addEventListener('DOMContentLoaded', function() {
    const searchInputs = document.querySelectorAll('.search-input');
    
    searchInputs.forEach(input => {
        input.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            // Add your search logic here
            console.log('Searching for:', searchTerm);
        });
    });
});

// Filter functionality (to be connected to backend)
document.addEventListener('DOMContentLoaded', function() {
    const filterSelects = document.querySelectorAll('.filter-select');
    
    filterSelects.forEach(select => {
        select.addEventListener('change', function() {
            const filterValue = this.value;
            // Add your filter logic here
            console.log('Filtering by:', filterValue);
        });
    });
});

// Form submission (to be connected to backend)
document.addEventListener('DOMContentLoaded', function() {
    const modalForm = document.getElementById('modalForm');
    
    if (modalForm) {
        modalForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Add your form submission logic here
            // This is where you would send data to your PHP backend
            
            console.log('Form submitted');
            alert('Données enregistrées avec succès!');
            closeModal();
        });
    }
});

// Export functionality placeholder
function exportData(format) {
    alert('Export en ' + format + ' - Fonctionnalité à implémenter avec PHP');
    // This would typically call a PHP script that generates the file
}

// Chart animation on load
document.addEventListener('DOMContentLoaded', function() {
    const bars = document.querySelectorAll('.bar');
    
    bars.forEach((bar, index) => {
        setTimeout(() => {
            bar.style.opacity = '0';
            bar.style.transform = 'scaleY(0)';
            bar.style.transition = 'all 0.8s ease';
            
            setTimeout(() => {
                bar.style.opacity = '1';
                bar.style.transform = 'scaleY(1)';
            }, 100);
        }, index * 200);
    });
});

// Utility function to format date
function formatDate(dateString) {
    const date = new Date(dateString);
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const year = date.getFullYear();
    return `${day}/${month}/${year}`;
}

// Utility function to format time
function formatTime(timeString) {
    return timeString;
}

// Table sorting functionality (optional)
function sortTable(columnIndex) {
    const table = event.target.closest('table');
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    
    rows.sort((a, b) => {
        const aText = a.cells[columnIndex].textContent;
        const bText = b.cells[columnIndex].textContent;
        return aText.localeCompare(bText);
    });
    
    rows.forEach(row => tbody.appendChild(row));
}

// Add this to make table headers sortable
document.addEventListener('DOMContentLoaded', function() {
    const tableHeaders = document.querySelectorAll('.data-table th');
    
    tableHeaders.forEach((header, index) => {
        header.style.cursor = 'pointer';
        header.addEventListener('click', () => sortTable(index));
    });
});

/* 
    Backend Integration Notes:
    
    1. Form Submissions:
       - Use fetch() or XMLHttpRequest to send data to PHP
       - Example: fetch('api/add_course.php', { method: 'POST', body: formData })
    
    2. Data Loading:
       - Fetch data from PHP on page load
       - Example: fetch('api/get_courses.php').then(res => res.json())
    
    3. CRUD Operations:
       - Create: POST to api/create.php
       - Read: GET from api/read.php
       - Update: PUT/POST to api/update.php
       - Delete: DELETE/POST to api/delete.php
    
    4. Search & Filter:
       - Send search terms as query parameters
       - Example: fetch('api/search.php?term=' + searchTerm)
    
    5. Export:
       - Link to PHP script that generates file
       - Example: window.location.href = 'api/export.php?format=pdf'
*/