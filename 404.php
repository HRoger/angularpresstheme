<?php
/**
 * The template for displaying 404 pages
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

                    <article id="post-0" class="post error404 no-results not-found">
                        <header class="entry-header">
                            <h1 class="entry-title"><?php _e('This is somewhat embarrassing, isn&rsquo;t it?', 'reactor'); ?></h1>
                        </header>
        
                        <div class="entry-content panel">
                            <p><?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching will help.', 'reactor'); ?></p>
                            <?php get_search_form(); ?>
                        </div><!-- .entry-content -->
                    </article><!-- #post-0 -->
            
				<?php reactor_inner_content_after(); ?>
                
                </div><!-- .columns -->
                
            </div><!-- .row -->
        </div><!-- #content -->
        
        <?php reactor_content_after(); ?>
        
	</div><!-- #primary -->

<?php get_footer(); ?>