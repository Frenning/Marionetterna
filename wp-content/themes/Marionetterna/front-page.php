<?php
/**
 * Separate homepage file
 * Only display on front page
 */
?>      
  <?php $fp_posts = get_field("fp-posts", get_the_id());?>
  <?php get_header(); ?>
  <div id="primary" class="col-md-12">
    <div class="pageContent col-xl-6 col-lg-7 col-md-8">
      <h1 class="alignCenter">
        <?php echo wp_kses_post(get_bloginfo('description')); ?>
      </h1>
      <div class="postArea">
        <?php foreach($fp_posts as $post){ ?>
          <div class="fp-posts">
            <?php echo $post->post_content; ?>
          </div>
        <?php } ?>
      </div>
    </div><!--frontPageContent-->
  </div><!-- #primary -->
  <div class="scroll-to-top"><i class="fa fa-angle-up"></i></div><!-- .scroll-to-top -->
</div><!-- close .row -->
<?php get_footer(); ?>