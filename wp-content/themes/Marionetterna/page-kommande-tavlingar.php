<?php
/**
* Kommande Tävlingar
*/

get_header(); ?>
</div><!-- close .row -->
</div><!-- close .container -->
<div class="row">
  <div id="primary" class="col-md-12">
    <div class="pageContent col-xl-6 col-lg-7 col-md-8">
      <h1><?php the_title();?></h1>
		<?php 
				read_page_content_from_url('https://dans.se/tools/comp/events/?org=marionetterna');
		?>	
    </div>
  </div>
</div>
<?php get_footer(); ?>