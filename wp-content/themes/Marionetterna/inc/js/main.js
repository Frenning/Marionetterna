jQuery(document).ready(function($) {
    $('#submit, .wpcf7-submit, .comment-reply-link, input[type="submit"]').addClass("btn btn-default"), $(".wp-caption").addClass("thumbnail"), $(".widget_rss ul").addClass("media-list"), $("table#wp-calendar").addClass("table table-striped"), $(window).scroll(function() {
            $(this).scrollTop() > 100 ? $(".scroll-to-top").fadeIn() : $(".scroll-to-top").fadeOut()
        }), $(".scroll-to-top").click(function() {
            return $("html, body").animate({
                scrollTop: 0
            }, 800), !1
        }),
        function() {
            var t = navigator.userAgent.toLowerCase().indexOf("webkit") > -1,
                e = navigator.userAgent.toLowerCase().indexOf("opera") > -1,
                n = navigator.userAgent.toLowerCase().indexOf("msie") > -1;
            (t || e || n) && document.getElementById && window.addEventListener && window.addEventListener("hashchange", function() {
                var t, e = location.hash.substring(1);
                /^[A-z0-9_-]+$/.test(e) && (t = document.getElementById(e), t && (/^(?:a|select|input|button|textarea)$/i.test(t.tagName) || (t.tabIndex = -1), t.focus()))
            }, !1)
        }()

        $('#hamburger-button').click(function(e){
            e.preventDefault();
            $(e.currentTarget).toggleClass('is-active');
            $('#navbar').toggleClass('overlay-active');
        });
});
jQuery(window).load(function() {
    jQuery(".flexslider").length && jQuery(".flexslider").flexslider({
        animation: "fade",
        controlNav: !0,
        prevText: "",
        nextText: "",
        smoothHeight: !0
    })
});