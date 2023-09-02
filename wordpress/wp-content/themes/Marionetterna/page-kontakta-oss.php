<?php
/**
* Kontakt
*/

get_header(); ?>
<div id="primary" class="col-md-12">
	<div class="pageContent col-sm-12 col-md-6">
		<h1> <?php the_title(); ?></h1>
		<div class="row">
			<div class="col-sm-6">
			<?php 
				$kontakt = pods('kontakt', $id="adress"); 
				echo $kontakt->display('content');
			?>
			</div>
			<div class="col-sm-6">
			<?php 
				$kontakt = pods('kontakt', $id="sjukanmalan");
				echo $kontakt->display('content');
				$kontakt = pods('kontakt', $id="mail");
				echo $kontakt->display('content');
			?>
			</div>
		</div> <!--row-->		
		<a href="<?php $kontakt = pods('kontakt', $id="adress");
		echo $kontakt->field('link'); ?>">Större karta</a>
		<div class="maps-image">
			<a href="<?php echo $kontakt->field('link'); ?>"><?php echo get_the_post_thumbnail($kontakt->ID()); ?></a>
		</div>
	</div>
</div><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>


