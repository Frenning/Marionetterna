<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package dazzling
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<style type="text/css">
	@import url(https://dans.se/shop/shop.css);
	@import url(https://dans.se/data/stylesheets/KYFPKgYjF9DhBWcn358egeJX.css);
</style>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<nav class="navbar navbar-default" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<div id="logo">
					<!--<?php echo is_home() ?  '<h1 class="site-title">' : '<span class="site-title">'; ?> -->
						<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="logo" src="<?php bloginfo('template_directory'); ?>/assets/images/logo_50x50.png" alt="" /> <title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					<!--<?php echo is_home() ?  '</h1>' : '</span>'; ?> end of .site-name -->
				</div><!-- end of #logo -->
			</div>
			<?php 
				// TODO: replace dazzling header
				//header_nav_menu("primary");
				dazzling_header_menu(); 
			?>
			<button id="hamburger-button" class="hamburger hamburger--elastic" type="button">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</button>
		</div>
	</nav><!-- .site-navigation -->
	<div id="content" class="site-content">		
		<?php
			global $post;
			if( get_post_meta($post->ID, 'site_layout', true) ){
					$layout_class = get_post_meta($post->ID, 'site_layout', true);
			}
			else{
					$layout_class = of_get_option( 'site_layout' );
			}
			if( is_home() && is_sticky( $post->ID ) ){
					$layout_class = of_get_option( 'site_layout' );
			}
		?>
		<div class="row <?php echo $layout_class; ?>">
