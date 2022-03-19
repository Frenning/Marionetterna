<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package dazzling
 */

get_header(); ?>	 
<div id="primary" class="content-area col-sm-12 col-md-9">
	<div class="content-inside col-md-12">
		<h1><?php the_title();?></h1>
		<p><?php echo (the_content());?></p>
	</div><!--content-inside-->
</div><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>