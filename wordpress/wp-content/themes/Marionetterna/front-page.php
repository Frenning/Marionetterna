<?php
/**
 * Separate homepage file
 * Only display on front page
 */
?>      
  <?php $fp_posts = get_field("fp-posts", get_the_id());?>
  <?php get_header(); ?>
  <div id="primary" class="col-md-12">
    <div class="align-center col-md-9">
      <h1>
        <?php echo wp_kses_post(get_bloginfo('description')); ?>
      </h1>
    </div>
    <div class="frontPageContent col-md-9">
      <div class="post-area col-md-9">
        <?php foreach($fp_posts as $post){ ?>
          <div class="fp-posts">
            <?php echo $post->post_content; ?>
          </div>
        <?php } ?>
        <?php $kursURL = get_permalink(get_page_by_title('Kursschema'))?>
      </div>
      <button class="frontPageButton">
        <a href="<?php echo $kursURL?>">Gå till kursschema!</a>
      </button>  
    </div><!--frontPageContent-->  
  </div><!-- #primary -->
</div><!-- close .row -->
<div class="row">
  <div id="secondary" class="col-md-12">
    <div class="pageContent col-md-9">
      <?php echo do_shortcode("[custom-facebook-feed]"); ?>  
    </div>
  </div>
</div>
<div class="row">
  <?php get_sidebar();?>
</div>
<?php get_footer(); ?>