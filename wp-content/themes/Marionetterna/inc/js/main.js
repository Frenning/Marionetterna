jQuery(document).ready(function($) {
    $('#submit, .wpcf7-submit, .comment-reply-link, input[type="submit"]').addClass("btn btn-default"), $(".wp-caption").addClass("thumbnail"), $(".widget_rss ul").addClass("media-list"), $("table#wp-calendar").addClass("table table-striped"), $(window).scroll(function() {
            $(this).scrollTop() > 100 ? $(".scroll-to-top").fadeIn() : $(".scroll-to-top").fadeOut()
        }), $(".scroll-to-top").click(function() {
            return $("html, body").animate({
                scrollTop: 0
            }, 800), !1
        }),

        $('#hamburger-button').click(function(e){
            e.preventDefault();
            $(e.currentTarget).toggleClass('is-active');
            $('#navbar').toggleClass('overlay-active');
        });
});