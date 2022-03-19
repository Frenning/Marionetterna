<?php
/**
 * Separate homepage file
 * Only display on front page
 */
?>      
<?php $fp_posts = get_field("fp-posts", get_the_id());?>
<?php get_header(); ?>
<div id="primary" class="col-sm-12 col-md-9">
  <div class="content-inside col-md-12">
      <h1 class="heading8">
      <?php echo wp_kses_post(get_bloginfo('description')); ?>
      </h1>
      <div class="post-area col-md-12">
        <?php foreach($fp_posts as $post){ ?>
          <div class="fp-posts">
            <?php echo $post->post_content; ?>
          </div>
        <?php } ?>
      </div>        
  </div><!--content-inside-->
</div><!-- #primary -->
<?php get_sidebar();?>
</div><!-- close .row -->
</div><!-- close .container -->
<div class="row">
  <div id="primary" class="col-md-12 content-area">
    <div class="main-content-area">
      <?php echo do_shortcode("[custom-facebook-feed]"); ?>  
    </div>
  </div>
</div>
<?php get_footer(); ?>