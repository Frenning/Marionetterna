<?php
/**
 * Separate homepage file
 * Only display on front page
 */
?>      
  <?php $fp_posts = get_field("fp-posts", get_the_id());?>
  <?php get_header(); ?>
  <div id="primary" class="backgroundImage col-md-12">
    <div class="pageContent col-md-5">
      <h1 class="alignCenter">
        <?php echo wp_kses_post(get_bloginfo('description')); ?>
      </h1>
      <div class="postArea">
        <?php foreach($fp_posts as $post){ ?>
          <div class="fp-posts">
            <?php echo $post->post_content; ?>
          </div>
        <?php } ?>
        <?php $kursURL = get_permalink(get_page_by_title('Kursschema'))?>
        <button class="frontPageButton">
          <a href="<?php echo $kursURL?>">Gå till kursschema!</a>
        </button>  
      </div>
    </div><!--frontPageContent-->
  </div><!-- #primary -->
</div><!-- close .row -->
<div class="row">
  <div id="secondary" class="col-md-12">
    <div class="pageContent col-md-5">
      <?php echo do_shortcode("[custom-facebook-feed]"); ?>  
    </div>
  </div>
</div>
<?php get_footer(); ?>