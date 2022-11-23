<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package dazzling
 */
?>
<div id="sidebar" class="col-md-12 hidden-sm-down" role="complementary">
	<div class="col-md-9 widget-area">
		<?php do_action( 'before_sidebar' ); ?>
		<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>
		<?php endif; // end sidebar widget area ?>
	</div>
</div><!-- #secondary -->
