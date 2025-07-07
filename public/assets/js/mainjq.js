$(document).ready(function () {
    // Use event delegation for dropdowns
    $(document).on('click', '.btn-toggle-dropdown', function (e) {
        e.stopPropagation();
        const $dropdown = $(this).closest('.relative').find('.dropdown-menu');
        const isExpanded = $(this).attr('aria-expanded') === 'true';

        $('.dropdown-menu').not($dropdown).removeClass('show');
        $('.btn-toggle-dropdown').not(this).attr('aria-expanded', 'false');

        if (isExpanded) {
            $dropdown.removeClass('show');
        } else {
            $dropdown.addClass('show');
        }

        $(this).attr('aria-expanded', !isExpanded);
    });

    $(document).on('click', function () {
        $('.dropdown-menu').removeClass('show');
        $('.btn-toggle-dropdown').attr('aria-expanded', 'false');
    });

    $(document).on('click', '.dropdown-menu', function (e) {
        e.stopPropagation();
    });
});