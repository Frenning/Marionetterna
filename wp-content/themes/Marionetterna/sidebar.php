<?php
/**
 * The Sidebar containing the main widget areas.
 */
?>
<div id="sidebar" class="col-xl-6 col-lg-8 hidden-sm-down" role="complementary">
	<?php do_action( 'before_sidebar' ); ?>
	<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>
	<?php endif; // end sidebar widget area ?>
</div><!-- #secondary -->
