<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 */
get_header(); ?>
	<div id="primary" class="headline-area col-md-12">
		<h1 class="headline"><?php the_title();?></h1>
	</div><!-- #primary -->
</div><!-- close .row -->
</div><!-- close .container -->
<div class="row">
  <div id="primary" class="col-md-12 content-area">
    <div class="main-content-area">
		<p><?php echo (the_content());?></p>
    </div>
  </div>
</div>
<?php get_footer(); ?>
