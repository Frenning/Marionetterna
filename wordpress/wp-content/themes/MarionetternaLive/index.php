<?php get_header();?>

<div class="content">
  <div class="gridContainer">
    <div class="row">
      <div class="col-xs-8 col-sm-8">
        <div class="post-list <?php if (!is_active_sidebar('sidebar-1')) echo 'post-list-large'; ?>">
          <?php
              if (have_posts()):
                while (have_posts()): the_post();
                  get_template_part('template-parts/content', get_post_format());
                endwhile;
                
                the_posts_pagination(array(
                    'prev_text'          => __('Previous', 'business-express'),
                    'next_text'          => __('Next', 'business-express'),
                    'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'business-express') . ' </span>',
                ));
              else:
                get_template_part('template-parts/content', 'none');
              endif;
          ?>

        </div> 
      </div>
      <div class="col-xs-4 col-sm-4">
        <?php get_sidebar();?> 
      </div>
    </div> 
  </div>
</div>

<?php get_footer();?>