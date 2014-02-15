<?php
/**
 * The template for displaying archive pages
 *
 * @package Reactor
 * @subpackge Templates
 * @since 1.0.0
 */
?>

<?php get_header(); ?>

	<div id="primary" class="site-content">
    
    	<?php reactor_content_before(); ?>
    
        <div id="content" role="main">
        	<div class="row">
                <div class="<?php reactor_columns(); ?>">
                
                <?php reactor_inner_content_before(); ?>
                
                <header class="archive-header">
                    <h1 class="archive-title"><?php
                        if ( is_day() ) :
                            printf( __('Daily Archives: %s', 'reactor'), '<span>' . get_the_date() . '</span>');
                        elseif ( is_month() ) :
                            printf( __('Monthly Archives: %s', 'reactor'), '<span>' . get_the_date( _x('F Y', 'monthly archives date format', 'reactor') ) . '</span>');
                        elseif ( is_year() ) :
                            printf( __('Yearly Archives: %s', 'reactor'), '<span>' . get_the_date( _x('Y', 'yearly archives date format', 'reactor') ) . '</span>');
                        else :
                            post_type_archive_title();
                        endif;
                    ?></h1>
                </header><!-- .archive-header -->
                
				<?php // get the loop
				get_template_part('loops/loop', 'portfolio'); ?>
                
                <?php reactor_inner_content_after(); ?>
                
                </div><!-- .columns -->
                
                <?php get_sidebar(); ?>
                
            </div><!-- .row -->
        </div><!-- #content -->
        
        <?php reactor_content_after(); ?>
        
	</div><!-- #primary -->

<?php get_footer(); ?>