(function ($) {
    // Upon cancel/close popup, update popup status via ajax
    $("#oc_login_masking_overlay_wrap .oc_cancel_btn, #oc_login_masking_overlay_wrap .oc_login_masking_close").click(function () {
        $("#oc_login_masking_overlay").hide();
        $(".loading-overlay.fullscreen-loader").removeClass('show');
        ajax_popup_update();
    });

    // Save session token along with never_show state
    function ajax_popup_update() {
        let data = {
            action: 'update_popup_info',
            never_show: $("#disable-masking-prompt").is(":checked") ? 1 : 0
        };
        $.post(ajaxurl, data, function (res) {
            if (res.status === 'success') {
                console.log("ALP popup info saved.");
            } else {
                console.log("Failed to save ALP popup info.");
            }
        });
    }
})(jQuery);