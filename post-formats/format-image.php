<?php
/**
 * The template for displaying the image post format
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
            
            <div class="entry-content">
<!--                --><?php //the_content(); ?>
	            <div ng-bind-html="item.content"></div>
            </div><!-- .entry-content -->
    
            <footer class="entry-footer">
            	<div class="panel">
                	<?php reactor_post_footer(); ?>
                </div>
            </footer><!-- .entry-footer -->
            
        </div><!-- .entry-body -->
	</article><!-- #post -->