<?php
/**
* Kursinformation
*/
?>
<?php $ki_posts = get_field("ki-posts", get_the_id());?>
<?php get_header(); ?>
<div id="primary" class="col-md-12">
  <div class="pageContent col-md-6">
		<h1><?php the_title(); ?></h1>
    <?php foreach($ki_posts as $post){ ?>
        <div class="ki-posts">
          <?php echo $post->post_content; ?>
        </div>
    <?php } ?>
    <?php while ( have_posts() ) : the_post(); ?>
				<p><?php echo strip_tags(the_content());?></p>
    <?php endwhile; ?>
	</div><!--pageContent-->
</div><!-- #primary -->
<div class="row">
  <?php get_sidebar();?>
</div>
<?php get_footer(); ?>


