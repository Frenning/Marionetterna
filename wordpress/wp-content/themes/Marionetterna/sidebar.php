<?php
/**
 * The Sidebar containing the main widget areas.
 */
?>
<div id="sidebar" class="col-md-8 hidden-sm-down" role="complementary">
	<div class="widget-area">
		<?php do_action( 'before_sidebar' ); ?>
		<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>
		<?php endif; // end sidebar widget area ?>
	</div>
</div><!-- #secondary -->
