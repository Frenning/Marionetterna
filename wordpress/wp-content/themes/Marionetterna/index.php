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
</div><!-- close .row -->
</div><!-- close .container -->
<div class="row">
  <div id="primary" class="col-md-12">
    <div class="pageContent col-md-6">
      <h1><?php the_title();?></h1>
      <p><?php echo (the_content());?></p>
    </div>
  </div>
</div>
<?php get_footer(); ?>