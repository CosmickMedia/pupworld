document.addEventListener('DOMContentLoaded', function () {
    var menuItems = document.querySelectorAll('#primary-menu > li');
    menuItems.forEach(function (item) {
        item.classList.add('nav-item');
        var link = item.querySelector('a');
        if (link) {
            link.classList.add('nav-link');
        }
    });

    var dropdownParents = document.querySelectorAll('#primary-menu li.menu-item-has-children');
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
});
