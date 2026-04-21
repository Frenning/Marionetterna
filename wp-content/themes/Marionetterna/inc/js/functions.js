jQuery(document).ready(function($) {
        // Apply Bootstrap classes for some WordPress components
    $('#submit, .wpcf7-submit, .comment-reply-link, input[type="submit"]').addClass('btn btn-default');
    $('.wp-caption').addClass('thumbnail');
    $('.widget_rss ul').addClass('media-list');
    $('table#wp-calendar').addClass('table table-striped');

        // Scroll to top
        // Makes scroll to top appear only when user starts to scroll down
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('.scroll-to-top').fadeIn();
        } else {
            $('.scroll-to-top').fadeOut();
        }
    });
    // Animation for scroll to top
    $('.scroll-to-top').click(function() {
        $('html, body').animate({
            scrollTop: 0
        }, 800);
        return false;
    });

    document.querySelectorAll('.navbar-dropdown-menus li').forEach(item => {
        item.addEventListener('click', () => {
            document.querySelectorAll('.navbar-dropdown-menus li').forEach(i => i.classList.remove('active'));
            item.classList.add('active');
        });
    });

});