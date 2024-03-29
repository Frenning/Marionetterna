<?php
$template = new OnecomTemplate();
$is_premium = $template->onecom_is_premium('all_plugins');
$is_mwp = $template->onecom_is_premium();
?>
<div class="wrap ocsh-wrap">
    <?php
        if (!$is_mwp) {
            onecom_premium_theme_admin_notice();
        }
    ?>

    <div class="inner one_wrap">
        <div class="wrap_inner">
            <div class="onecom_critical__wrap critical" id="critical">
                <ul class="critical"></ul>
            </div>
            <div class="onecom_head">
                <div class="onecom_head__inner onecom_head_left">
                    <h2 class="onecom_heading"><?php echo $template->get_title(); ?></h2>
                    <p class="onecom_description"><?php echo $template->get_description(); ?></p>
                </div>
                <div class="onecom_head__inner onecom_head_right" <?php if(!$is_premium){ echo 'style="display:none"';} ?>>
                    <div class="onecom_card">
                        <span class="onecom_card_title"><?php echo __( 'Score', OC_PLUGIN_DOMAIN ) ?>

                            <div class="tooltip">
                            <img
                                    class="onecom_info_icon"
                                    src="<?php echo $template->get_info_icon(); ?>"
                                    alt="info">
                                <img
                                        class="onecom_up-arrow"
                                        src="<?php echo ONECOM_WP_URL ?>modules/health-monitor/assets/images/arrow-up.svg"
                                        alt="info">
                            <span class="tooltiptext"><?php echo __( "Recommendations are common security and performance improvements you can do to enhance your site's defense against hackers and bots.", $this->text_domain ) ?></span>
                        </div>
                        </span>
                        <span id="onecom_card_result" class="onecom_card_value"><span class="poor">0%</span></span>

                    </div>
                    <div class="onecom_card">
                        <span class="onecom_card_title"><?php echo __( 'To do', OC_PLUGIN_DOMAIN ); ?>
                            <div class="tooltip">
                            <img
                                    class="onecom_info_icon"
                                    src="<?php echo $template->get_info_icon(); ?>"
                                    alt="info">
                            <img
                                    class="onecom_up-arrow"
                                    src="<?php echo ONECOM_WP_URL ?>modules/health-monitor/assets/images/arrow-up.svg"
                                    alt="info">
                            <span class="tooltiptext"><?php echo __( "Recommendations are common security and performance improvements you can do to enhance your site's defense against hackers and bots.", $this->text_domain ) ?></span>
                        </div>
                        </span>
                        <span id="onecom_card_todo_score" class="onecom_card_value">0</span>
                    </div>
                </div>

            </div>
        </div>
        <div class="onecom_body">
        <div class="h-parent-wrap" <?php if(!$is_premium){ echo 'style="display:none"';} ?>>
            <div class="h-parent">
			    <div class="h-child">
                    <div class="onecom_tabs_container" data-error="<?php echo ini_get( 'display_errors' ); ?>">
                    <div class="onecom_tab active" data-tab="todo"><?php echo __( 'To do', OC_PLUGIN_DOMAIN ) ?>
                        <span
                                class="count" id="todo_count">0</span></div>
                    <div class="onecom_tab" data-tab="done"><?php echo __( 'Done', OC_PLUGIN_DOMAIN ) ?><span
                                class="count" id="done_count">0</span></div>
                    <div class="onecom_tab" data-tab="ignored"><?php echo __( 'Ignored', OC_PLUGIN_DOMAIN ) ?><span
                                class="count" id="ignored_count">0</span></div>
                    </div>
                </div>
            </div>
            </div>
            <div class="onecom_tabs_panels" <?php if(!$is_premium){ echo 'style="display:none"';} ?>>
                <div class="onecom_tabs_panel todo" id="todo">
                    <ul id="plugin-filter" class="todo"></ul>
                </div>
                <div class="onecom_tabs_panel done oc_hidden" id="done">
                    <ul class="done"></ul>
                </div>
                <div class="onecom_tabs_panel ignored oc_hidden" id="ignored">
					<?php echo $template->get_ignored_ul() ?>
                </div>
            </div>
            <?php if(!$is_premium){ ?>
                <div class="innerNoFound" style="text-align:center;color:#8A8989;">
                    <img src="<?php echo ONECOM_WP_URL ?>modules/health-monitor/assets/images/beginner-icon.svg"
                         alt="<?php echo __('Get access to Health Monitor and more for free with Managed WordPress.', OC_PLUGIN_DOMAIN); ?>">
                    <p><?php echo sprintf(__('Get access to Health Monitor and more for free with Managed WordPress.%s %sGet Started%s', OC_PLUGIN_DOMAIN),'<br>','<a href="'.oc_upgrade_link('top_banner').'" target="_blank" style="font-weight:600;text-decoration:none;">','</a>'); ?></p>
                </div>

            <?php } ?>
        </div>
    </div>
</div>