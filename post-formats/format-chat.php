<?php
/**
 * The template for displaying the status post format
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
            
            <header class="entry-header large-2 small-2 columns">
                <?php echo get_avatar( get_the_author_meta('ID'), apply_filters('reactor_status_avatar', '57') ); ?>
                <p class="entry-author">
<!--	                --><?php //the_author(); ?><!--</p>-->
	            <div ng-bind-html="item.author.name"></div>
            </header><!-- .entry-header -->
    
            <div class="entry-content large-offset-2 small-offset-2">
<!--                --><?php //the_content(); ?>
	            <div ng-bind-html="item.content"></div>
            </div><!-- .entry-content -->
    
            <footer class="entry-footer">
            	<?php reactor_post_footer(); ?>
            </footer><!-- .entry-footer -->
        </div><!-- .entry-body -->
	</article><!-- #post -->