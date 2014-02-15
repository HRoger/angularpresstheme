<?php
/**
 * The template for displaying portfolio posts by tag
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
                        <h1 class="archive-title"><?php printf( __('Tag: %s', 'reactor'), '<span>' . single_cat_title('', false) . '</span>'); ?></h1>
        
						<?php if ( category_description() ) : // Show an optional tag description ?>
						<div class="archive-meta">
							<?php echo category_description(); ?>
						</div>
						<?php endif; ?>
                    </header><!-- .archive-header -->
                    
                    <?php // category submenu function
					if ( current_theme_supports('reactor-taxonomy-subnav') ) {
						reactor_category_submenu( array('taxonomy' => 'portfolio-tag', 'quicksand' => false) ); 
					} ?>
        
					<?php // get the portfolio loop
					get_template_part('loops/loop', 'portfolio'); ?>
                
                <?php reactor_inner_content_after(); ?>
                
                </div><!-- .columns -->
                
                <?php get_sidebar(); ?>
                
            </div><!-- .row -->
        </div><!-- #content -->
        
        <?php reactor_content_after(); ?>
        
	</div><!-- #primary -->

<?php get_footer(); ?>