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
 * @package marionetterna
 */

get_header(); ?>
</div><!-- close .row -->
</div><!-- close .container -->
<div class="row">
  <div id="primary" class="col-md-12">
    <div class="page-content col-xl-6 col-lg-7 col-md-8">
      <h1><?php the_title();?></h1>
      <div class="content-area">
        <p><?php echo (the_content());?></p>
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>