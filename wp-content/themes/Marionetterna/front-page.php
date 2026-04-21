<?php
/**
 * Separate homepage file
 * Only display on front page
 */
?>      
  <?php get_header(); ?>
  <div id="primary" class="col-md-12">
    <div class="page-content col-xl-6 col-lg-7 col-md-8">
      <h1 class="align-center">
        <?php echo wp_kses_post(get_bloginfo('description')); ?>
      </h1>
      <div class="content-area">
        <?php
          $post_id = 100;
          $post = get_post($post_id);

          if ($post) {
              echo '<div class="fp-posts">' . apply_filters('the_content', $post->post_content) . '</div>';
          }
        ?>
      </div>
    </div><!--frontPageContent-->
  </div><!-- #primary -->
  <div class="scroll-to-top"><i class="fa fa-angle-up"></i></div><!-- .scroll-to-top -->
</div><!-- close .row -->
<?php get_footer(); ?>