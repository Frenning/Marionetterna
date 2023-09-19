<?php
/**
* Kommande Tävlingar
*/

get_header(); ?>
<div id="primary" class="content-area col-sm-12 col-md-9">
	<div class="content-inside col-md-12">
		<?php 
			read_page_content_from_url('https://dans.se/tools/comp/events/?org=marionetterna');
		?>	
	</div><!--content-inside-->
</div><!-- #primary -->
<?php get_footer(); ?>


