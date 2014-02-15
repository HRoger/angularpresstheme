<?php
/**
 * The template for displaying author archive pages
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
                
				<?php if ( have_posts() ) : the_post(); ?>
        
                    <header class="archive-header">
                        <h1 class="archive-title"><?php printf( __('Author: %s', 'reactor'), get_the_author() ); ?></h1>
                    </header><!-- .archive-header -->
        
                    <?php rewind_posts(); ?>
        
                    <?php // If a user has filled out their description, show a bio on their entries.
                    if ( get_the_author_meta('description') ) : ?>
                    <div class="author-info">
                        <div class="author-avatar">
                            <?php echo get_avatar( get_the_author_meta('user_email'), apply_filters('reactor_author_bio_avatar_size', 60) ); ?>
                        </div><!-- .author-avatar -->
                        <div class="author-description">
                            <h2><?php printf( __('About %s', 'reactor'), get_the_author() ); ?></h2>
                            <p><?php the_author_meta('description'); ?></p>
                        </div><!-- .author-description	-->
                    </div><!-- .author-info -->
                    <?php endif; ?>

                <?php endif; // end have_posts() check ?> 
                
				<?php // get the loop
				get_template_part('loops/loop', 'index'); ?>
                
                <?php reactor_inner_content_after(); ?>
                
                </div><!-- .columns -->
                
                <?php get_sidebar(); ?>
                
            </div><!-- .row -->
        </div><!-- #content -->
        
        <?php reactor_content_after(); ?>
        
	</div><!-- #primary -->

<?php get_footer(); ?>