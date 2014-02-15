<?php
/**
 * Reactor List Comments Callback
 * callback function for wp_list_comments in reactor/comments.php
 *
 * @package Reactor
 * @author Anthony Wilhelm (@awshout / anthonywilhelm.com)
 * @since 1.0.0
 * @license GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

if ( !function_exists('reactor_comments') ) :
	function reactor_comments( $comment, $args, $depth ) {
		do_action('reactor_comments', $comment, $args, $depth );
		
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
			// Display trackbacks differently than normal comments.
		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<p><?php _e('Pingback:', 'reactor'); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __('Edit', 'reactor'), '<div class="comment-edit-link"><span>', '</span></div>'); ?></p>
		<?php
		    break;
			default :
			// Proceed with normal comments.
			global $post;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<article id="comment-<?php comment_ID(); ?>" class="comment-entry comment">
				<header class="comment-meta comment-author">
					<?php
						echo get_avatar( $comment, 44 );
						printf('<cite class="fn">%1$s %2$s</cite>',
							get_comment_author_link(),
							// If current post author is also comment author, make it known visually
							( $comment->user_id === $post->post_author ) ? '<span> ' . __('Post author', 'reactor') . '</span>' : ''
						 );
						printf('<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
							esc_url( get_comment_link( $comment->comment_ID ) ),
							get_comment_time('c'),
							// translators: 1: date, 2: time
							sprintf( __('%1$s at %2$s', 'reactor'), get_comment_date(), get_comment_time() )
						 );
					?>
				</header><!-- .comment-meta -->
	
				<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'reactor'); ?></p>
				<?php endif; ?>
	
				<div class="comment-content comment">
					<?php comment_text(); ?>
					<?php edit_comment_link( __('Edit', 'reactor'), '<div class="edit-link"><span>', '</span></div>'); ?>
				</div><!-- .comment-content -->
				<div class="reply comment-reply-button">
					<?php comment_reply_link( array_merge( $args, array('reply_text' => __('Reply', 'reactor'), 'before' => '', 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .reply -->
			</article><!-- #comment-## -->
		<?php
			break;
		endswitch; // end comment_type check
	}
	endif;
?>