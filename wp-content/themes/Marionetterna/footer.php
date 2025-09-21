<?php
/**
 * The template for displaying the footer.
 * Contains the closing of the #content div and all content after
 * @package dazzling
 */
?>
</div><!-- close .site-content -->
	<div id="footer-area">
		<div id="colophon">
			<div class="row">
				<?php get_sidebar();?>
			</div>
			<div class="container">
				<div class="row footer-content col-md-8">
					<div class="footer-content col-md-4 col-sm-6">
						<?php
						$param = array(
							'limit' => -1,
						);
						$kontakt = pods('kontakt', $param);
						?>
						<?php echo $kontakt->display('content');?>
					</div>
					<div class="footer-content col-md-4 col-sm-6">
						<?php 
						$kontakt = pods('kontakt', $id="mail"); 
						echo $kontakt->display('content');
						$kontakt = pods('anvandarvillkor', $id="anvandarvillkor"); 
						echo $kontakt->display('content');
						$kontakt = pods('anvandarvillkor', $id="personliga-uppgifter"); 
						echo $kontakt->display('content');
						?>	
					</div>
					<div class="footer-content col-md-4 col-sm-12">
						<?php
						$param = array(
							'limit' => -1,
						);

						$socialmedia = pods('social-media', $param);
						while ( $socialmedia ->fetch() ) { 
						?>
						<a class="social-icons" href="<?php echo $socialmedia->field('medialink'); ?>"><?php echo get_the_post_thumbnail($socialmedia->ID()); ?></a>
						<?php 
						} 
						?>
					</div>
				</div>
			</div>
			<div class="scroll-to-top"><i class="fa fa-angle-up"></i></div><!-- .scroll-to-top -->
		</div><!-- #colophon -->
	</div><!-- #footer-area -->
</div><!-- #page -->
<?php wp_footer(); ?>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>