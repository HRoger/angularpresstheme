<?php
/**
 * The template for displaying page content
 *
 * @package Reactor
 * @subpackage Post-Formats
 * @since 1.0.0
 */
?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="entry-body">
            
            	<?php reactor_page_header(); ?>
                        
                <div class="entry-content">
                    <?php the_content(); ?>
<!--	                <div ng-bind-html="item.content"></div>-->
                </div><!-- .entry-content -->
                
                <footer class="entry-footer">
					<?php reactor_page_footer(); ?>
                </footer><!-- .entry-footer -->
                
            </div><!-- .entry-body -->
        </article><!-- #post -->