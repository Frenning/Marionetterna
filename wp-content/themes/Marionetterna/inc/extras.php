<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package dazzling
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function dazzling_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'dazzling_page_menu_args' );

if( !function_exists( 'dazzling_header_menu' ) ) :
/**
 * header menu (should you choose to use one)
 */
function dazzling_header_menu() {
  // display the WordPress Custom Menu if available
  wp_nav_menu(array(
    'menu'              => 'primary',
    'theme_location'    => 'primary',
    'depth'             => 2,
    'container'         => 'div',
    'container_class'   => 'collapse navbar-collapse navbar-ex1-collapse',
    'container_id'	    => 'navbar',
    'menu_class'        => 'nav navbar-nav',
    'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
    'walker'            => new wp_bootstrap_navwalker()
  ));
} /* end header menu */
endif;

/**
 * Get custom CSS from Theme Options panel and output in header
 */
if (!function_exists('get_dazzling_theme_options'))  {
  function get_dazzling_theme_options(){

    echo '<style type="text/css">';

    if ( of_get_option('link_color')) {
      echo 'a, #infinite-handle span {color:' . of_get_option('link_color') . '}';
    }
    if ( of_get_option('link_hover_color')) {
      echo 'a:hover {color: '.of_get_option('link_hover_color', '#000').';}';
    }
    if ( of_get_option('link_active_color')) {
      echo 'a:active {color: '.of_get_option('link_active_color', '#000').';}';
    }
    if ( of_get_option('element_color')) {
      echo '.btn-default, .label-default, .flex-caption h2, .navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus, .navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-nav > li > a:focus, .navbar-default .navbar-nav > .open > a, .navbar-default .navbar-nav > .open > a:hover, .navbar-default .navbar-nav > .open > a:focus, .dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus, .navbar-default .navbar-nav .open .dropdown-menu > li > a:hover, .navbar-default .navbar-nav .open .dropdown-menu > li > a:focus, .dropdown-menu > .active > a, .navbar-default .navbar-nav .open .dropdown-menu > .active > a {background-color: '.of_get_option('element_color', '#000').'; border-color: '.of_get_option('element_color', '#000').';} .btn.btn-default.read-more, .entry-meta .fa, .site-main [class*="navigation"] a, .more-link { color: '.of_get_option('element_color', '#000').'}';
    }
    if ( of_get_option('element_color_hover')) {
      echo '.btn-default:hover, .label-default[href]:hover, .label-default[href]:focus, #infinite-handle span:hover, .btn.btn-default.read-more:hover, .btn-default:hover, .scroll-to-top:hover, .btn-default:focus, .btn-default:active, .btn-default.active, .site-main [class*="navigation"] a:hover, .more-link:hover, #image-navigation .nav-previous a:hover, #image-navigation .nav-next a:hover  { background-color: '.of_get_option('element_color_hover', '#000').'; border-color: '.of_get_option('element_color_hover', '#000').'; }';
    }
    if ( of_get_option('cfa_bg_color')) {
      echo '.cfa { background-color: '.of_get_option('cfa_bg_color', '#000').'; } .cfa-button:hover {color: '.of_get_option('cfa_bg_color', '#000').';}';
    }
    if ( of_get_option('cfa_color')) {
      echo '.cfa-text { color: '.of_get_option('cfa_color', '#000').';}';
    }
    if ( of_get_option('cfa_btn_color')) {
      echo '.cfa-button {border-color: '.of_get_option('cfa_btn_color', '#000').';}';
    }
    if ( of_get_option('cfa_btn_txt_color')) {
      echo '.cfa-button {color: '.of_get_option('cfa_btn_txt_color', '#000').';}';
    }
    if ( of_get_option('heading_color')) {
      echo 'h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6, .entry-title {color: '.of_get_option('heading_color', '#000').';}';
    }
    if ( of_get_option('top_nav_bg_color')) {
      echo '.navbar.navbar-default {background-color: '.of_get_option('top_nav_bg_color', '#000').';}';
    }
    if ( of_get_option('top_nav_link_color')) {
      echo '.navbar-default .navbar-nav > li > a { color: '.of_get_option('top_nav_link_color', '#000').';}';
    }
    if ( of_get_option('top_nav_dropdown_bg')) {
      echo '.dropdown-menu, .dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus {background-color: '.of_get_option('top_nav_dropdown_bg', '#000').';}';
    }
    if ( of_get_option('top_nav_dropdown_item')) {
      echo '.navbar-default .navbar-nav .open .dropdown-menu > li > a { color: '.of_get_option('top_nav_dropdown_item', '#000').';}';
    }
    if ( of_get_option('footer_bg_color')) {
      echo '#colophon {background-color: '.of_get_option('footer_bg_color', '#000').';}';
    }
    if ( of_get_option('footer_text_color')) {
      echo '#footer-area, .site-info {color: '.of_get_option('footer_text_color', '#000').';}';
    }
    if ( of_get_option('footer_widget_bg_color')) {
      echo '#footer-area {background-color: '.of_get_option('footer_widget_bg_color', '#000').';}';
    }
    if ( of_get_option('footer_link_color')) {
      echo '.site-info a, #footer-area a {color: '.of_get_option('footer_link_color', '#000').';}';
    }
    if ( of_get_option('social_color')) {
      echo '#social a {color: '.of_get_option('social_color', '#000').' !important ;}';
    }
    if ( of_get_option('social_hover_color')) {
      echo '#social a:hover {color: '.of_get_option('social_hover_color', '#000').'!important ;}';
    }
    global $typography_options, $typography_defaults;

    $typography = of_get_option('main_body_typography', $typography_defaults);

    if ( $typography ) {
      $font_family = isset( $typography_options['faces'][$typography['face']] ) ? $typography_options['faces'][$typography['face']] : $typography_options['faces'][$typography_defaults['face']];
      $font_size = isset( $typography['size'] ) ? $typography['size'] : $typography_defaults['size'];
      $font_style = isset( $typography['style'] ) ? $typography['style'] : $typography_defaults['style'];
      $font_color = isset( $typography['color'] ) ? $typography['color'] : $typography_defaults['color'];
      echo '.entry-content {font-family: ' . $font_family . '; font-size:' . $font_size . '; font-weight: ' . $font_style . '; color:'.$font_color . ';}';
    }
    if ( of_get_option('custom_css')) {
      echo html_entity_decode( of_get_option( 'custom_css', 'no entry' ) );
    }
      echo '</style>';
  }
}
add_action('wp_head','get_dazzling_theme_options',10);

?>
