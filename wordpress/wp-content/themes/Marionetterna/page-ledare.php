<?php
/**
 * Ledare
 */
 ?>
<?php get_header();?>
<div id="primary" class="col-md-12">
    <div class="pageContent col-sm-12 col-md-6">
        <?php
            $param = array(
                'limit' => -1,
            );

            $ledare = pods('ledare', $param);

            while ( $ledare ->fetch() ) { 
                ?>
                <div class="img-leaders col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <?php 
                        if(get_the_post_thumbnail($ledare->ID())  != null)
                            echo get_the_post_thumbnail($ledare->ID());
                        else{
                            ?>
                            <img src="<?php echo get_template_directory_uri().'/assets/images/bild_saknas.png';  ?>" />
                            <?php
                        }
                        
                    ?>
                    <h5> <?php echo $ledare->display('title'); ?> </h5>	
                    <h6 class="nummer"><?php echo $ledare->field('phonenumber'); ?></h6>     
                </div>
                <?php
            }
        ?>
    </div>
</div>
<?php get_sidebar(); ?>
<?php get_footer();?>