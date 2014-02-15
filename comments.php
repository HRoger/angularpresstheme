<?php
/**
 * The template for displaying comments
 * uses callback reactor_comments in includes/comments.php
 *
 * @package Reactor
 * @subpackge Templates
 * @since 1.0.0
 */

// Do not delete these lines
if ( !empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die ('Please do not load this page directly. Thanks!');
} ?>

<?php if ( post_password_required() ) { ?>
<div class="alert help">
  <p class="nocomments">
    <?php _e('This post is password protected. Enter the password to view comments.', 'reactor'); ?>
  </p>
</div>
<?php return; } ?>

<?php if ( comments_open() || '0' != get_comments_number() ) : ?>
<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
    <h4 class="comments-title">
		<?php comments_number('<span>No</span> Comments', '<span>1</span> Comment', '<span>%</span> Comments');?> on &#8220;<?php the_title(); ?>&#8221;
    </h4>
    <ol class="commentlist">
		<?php wp_list_comments( array('callback' => 'reactor_comments', 'style' => 'ol') ); ?>
    </ol>
    
		<?php if ( get_comment_pages_count() > 1 && get_option('page_comments') ) : ?>
        <nav id="comment-nav-below" class="navigation" role="navigation">
            <div class="nav-previous"><?php previous_comments_link( __('&larr; Older Comments', 'reactor') ); ?></div>
            <div class="nav-next"><?php next_comments_link( __('Newer Comments &rarr;', 'reactor') ); ?></div>
        </nav>
		<?php endif; ?>
    
	<?php elseif ( !comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments') ) : ?>
        <p class="nocomments"><?php _e('Comments are closed.', 'reactor'); ?></p>
    <?php endif; ?>
    
    <?php if ( comments_open() ) : ?>
    <div id="respond-form">
		<div id="cancel-comment-reply">
			<p class="small">
				<?php cancel_comment_reply_link(); ?>
			</p>
		</div>
      
		<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<div class="alert help">
			<p><?php printf('You must be %1$slogged in%2$s to post a comment.', '<a href="<?php echo wp_login_url( get_permalink() ); ?>">', '</a>'); ?></p>
		</div>
      
      <?php else : 
	       comment_form( array( 
                'logged_in_as' => '<p class="comments-logged-in-as">' . __('Logged in as', 'reactor') . ' <a href="' . get_option('url') .'/wp-admin/profile.php">' . $user_identity . '</a>. <a href="' . wp_logout_url( get_permalink() ) . '" title="' . __('Log out of this account', 'reactor') . '">' . __('Log out', 'reactor') . '&raquo;</a></p>', 
				
                'fields' => array( 
                    'author' => '<div class="row"><p class="comment-form-author six columns"><label for="author">' . __('Name ', 'reactor') . ( $req ? __('( required )', 'reactor') : '') . '</label> '.'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . __('Your Name*', 'reactor') . '" tabindex="1"' . ( $req ? __( "aria-required='true'" ) : '') . ' /></p>',
				
					'email' => '<p class="comment-form-email six columns"><label for="email">' . __('Email ', 'reactor') . ( $req ? __('( required )', 'reactor') : '') . '</label> '.'<input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" placeholder="' . __('Your E-Mail*', 'reactor') . '" tabindex="2"' . ( $req ? __( "aria-required='true'" ) : '') . ' /></p>',
				
					'url' => '<p class="comment-form-url six columns end"><label for="url">' . __('Website ', 'reactor') . '</label>' . '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="' . __('URL ', 'reactor') . '" tabindex="3" /></p></div>',
                ),	
				
					'comment_field' => '<div class="row"><p class="comment-form-comment twelve columns"><textarea name="comment" id="comment" placeholder="' . __('Your Comment here...', 'reactor') . '" rows="8" tabindex="4"></textarea></p>',
				
					'comment_notes_after' => '<div class="alert info"><p id="allowed_tags" class="form-allowed-tags small twelve columns"><strong>XHTML: </strong>' . __('You can use these tags', 'reactor') . ' <code>' . allowed_tags() . '</code></p></div></div>',
				
					'label_submit' => __('Submit', 'reactor'),
				
					'id_submit' => 'submit',
				
					'class_submit' => 'button'
			) );  
		endif; ?>
            
    </div>
    <?php endif; ?>
</div><!-- end #comments -->
<?php endif; ?>
