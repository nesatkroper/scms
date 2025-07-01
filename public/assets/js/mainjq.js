$(document).ready(function () {

    $('.btn-toggle-dropdown').click(function (e) {
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

    $(document).click(function () {
        $('.dropdown-menu').removeClass('show');
        $('.btn-toggle-dropdown').attr('aria-expanded', 'false');
    });

    $('.dropdown-menu').click(function (e) {
        e.stopPropagation();
    });
});