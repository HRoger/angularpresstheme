<?php
/**
 * The template for displaying the aside post format
 *
 * @package Reactor
 * @subpackage Post-Formats
 * @since 1.0.0
 *
 * @package Reactor
 * @subpackage Post-Formats
 * @since 1.0.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>   	
        <div class="entry-body">
        
            <header class="entry-header">
            	<?php reactor_post_header(); ?>
            </header><!-- .entry-header -->
            
        	<div class="panel">
                <div class="entry-content">
<!--                    --><?php //the_content(); ?>
	                <div ng-bind-html="item.content"></div>
                </div><!-- .entry-content -->
        
                <footer class="entry-footer">
                	<?php reactor_post_footer(); ?>
                </footer><!-- .entry-footer -->
            </div>
            
        </div><!-- .entry-body -->
	</article><!-- #post -->