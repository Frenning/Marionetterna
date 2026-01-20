<?php
/**
 * marionetterna functions and definitions
 *
 * @package marionetterna
 */

// Adds theme support
if ( ! function_exists( 'marionetterna_setup' ) ) :
    function marionetterna_setup() {
      // Enable support for Post thumbnails.
      add_theme_support( 'post-thumbnails' );
      // Enable support for Post Formats.
      add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );

      /*
      * Let WordPress manage the document title.
      * By adding theme support, we declare that this theme does not use a
      * hard-coded <title> tag in the document head, and expect WordPress to
      * provide it for us.
      */
      add_theme_support( 'title-tag' );
    }
endif; // marionetterna_setup
add_action( 'after_setup_theme', 'marionetterna_setup' );

/**
 * Enqueue scripts and styles.
 */
function scripts() {
  wp_enqueue_style( 'marionetterna-style', get_template_directory_uri().'/inc/css/style.css' );

  wp_enqueue_script( 'marionetterna-main', get_template_directory_uri() . '/inc/js/main.js', array('jquery'), '1.5.4', true );
}
add_action( 'wp_enqueue_scripts', 'scripts' );

/**
 * Helper function to return the theme option value.
 * If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 *
 * Not in a class to support backwards compatibility in themes.
 */
if ( ! function_exists( 'of_get_option' ) ) :
function of_get_option( $name, $default = false ) {

  $option_name = '';
  // Get option settings from database
  $options = get_option( 'marionetterna' );

  // Return specific option
  if ( isset( $options[$name] ) ) {
    return $options[$name];
  }

  return $default;
}
endif;

/**
 * Custom functions that act independently of the theme templates.
 */
//require get_template_directory() . '/inc/extras.php';

if( !function_exists( 'marionetterna_header_menu' ) ) :
function marionetterna_header_menu() {
  // display the WordPress Custom Menu if available
  wp_nav_menu(array(
    'menu'              => 'primary',
    'theme_location'    => 'primary',
    'depth'             => 2,
    'container'         => 'div',
    'container_class'   => 'collapse navbar-collapse navbar-ex1-collapse',
    'container_id'	    => 'navbar',
    'menu_class'        => 'nav navbar-dropdown-menus',
    'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
    'walker'            => new wp_bootstrap_navwalker()
  ));
} /* end header menu */
endif;

/**
 * Load custom nav walker
 */
require get_template_directory() . '/navwalker.php';

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function widgets_init() {
  register_sidebar( array(
    'name'          => __( 'Sidebar', 'marionetterna' ),
    'id'            => 'sidebar-1',
    'before_widget' => '<div id="%1$s" class="widget col-xl-6 col-lg-6 col-sm-12 %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );
}
add_action( 'widgets_init', 'widgets_init' );