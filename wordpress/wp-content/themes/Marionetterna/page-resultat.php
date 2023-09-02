<?php
/**
* Tävlings Resultat
*/

get_header(); ?>
<div id="primary" class="col-md-12">
	<div class="pageContent resultat-scroll col-sm-12 col-md-6">
		<?php 
		  	//year=2018 = Filtrera ut år för eventuellt snabbare laddningstid.
			read_page_content_from_url('https://dans.se/tools/comp/results/?org=marionetterna;year=2018');
		?>
	</div><!--content-inside-->
</div><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>


