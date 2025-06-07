document.addEventListener('DOMContentLoaded', function () {
    function styleMenu(menuSelector) {
        var menuItems = document.querySelectorAll(menuSelector + ' > li');
        menuItems.forEach(function (item) {
            item.classList.add('nav-item');
            var link = item.querySelector('a');
            if (link) {
                link.classList.add('nav-link');
            }
        });

        var dropdownParents = document.querySelectorAll(menuSelector + ' li.menu-item-has-children');
        dropdownParents.forEach(function (parent) {
            parent.classList.add('dropdown');
            var link = parent.querySelector('a');
            if (link) {
                link.classList.add('dropdown-toggle');
                link.setAttribute('data-bs-toggle', 'dropdown');
                link.setAttribute('aria-expanded', 'false');
            }
            var submenu = parent.querySelector('.sub-menu');
            if (submenu) {
                submenu.classList.add('dropdown-menu');
            }
        });
    }

    styleMenu('#primary-menu');
    styleMenu('#primary-offcanvas-menu');
});
