document.addEventListener('DOMContentLoaded', function () {
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
