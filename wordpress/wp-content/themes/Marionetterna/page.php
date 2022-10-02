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
</div><!-- close .row -->
</div><!-- close .container -->
<div class="row">
  <div id="primary" class="col-md-12 content-area">
    <div class="main-content-area">
      <h1><?php the_title();?></h1>
      <p><?php echo (the_content());?></p>
    </div>
  </div>
</div>
<div class="row">
  <?php get_sidebar();?>
</div>
<?php get_footer(); ?>
