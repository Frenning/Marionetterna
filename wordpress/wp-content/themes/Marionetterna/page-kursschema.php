<?php
/**
* Kursschema
*/

get_header(); ?>
<div id="primary" class="col-sm-12">
	<div class="pageContent alignCenter">
		<h1>Kursschema</h1>
		<?php 
		//readfile("https://dans.se/tools/reg/?lang=sv&org=marionetterna;cat=0;format=htmlBody"); 
		echo do_shortcode("[cw shop org=marionetterna]");
		?>
		<?php 
			//read_page_content_from_url('https://dans.se/tools/reg/?lang=sv&org=marionetterna;cat=0');
		?>	
	</div><!--content-inside-->
</div><!-- #primary -->
<?php get_footer(); ?>


