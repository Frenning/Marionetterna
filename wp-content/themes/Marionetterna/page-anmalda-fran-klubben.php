<?php
/**
* Anmälda från klubben
*/

get_header(); ?>
<div id="primary" class="col-md-12">
	<div class="pageContent col-sm-12 col-md-6">
		<?php
			read_page_content_from_url('https://dans.se/tools/comp/registrations/?org=marionetterna');
		?>
	</div><!--content-inside-->
</div><!-- #primary -->
<?php get_footer(); ?>



