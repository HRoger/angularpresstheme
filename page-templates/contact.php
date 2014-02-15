<?php
/**
 * Template Name: Contact Page
 *
 * @package Reactor
 * @subpackge Page-Templates
 * @link http://www.catswhocode.com/blog/how-to-create-a-built-in-contact-form-for-your-wordpress-theme
 * @since 1.0.0
 */
update_option('current_page_template', 'contact');


?>

<?php // get the page options
/*$contact_email = reactor_option('contact_email_to', get_option('admin_email'));
$email_subject = reactor_option('contact_email_subject', get_bloginfo('name') . __(' - Contact Form Message', 'reactor'));
$msg_sent = reactor_option('contact_email_sent', __('Thank you! Your email was sent successfully.', 'reactor'));*/

// begin form validation
/*if (isset($_POST['submitted'])) {
	if (trim($_POST['contactName']) === '') {
		$nameError = apply_filters('reactor_contactform_error_name', '<small class="error">Please enter your name.</small>');
		$errorClass = 'error';
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
	}
	if (trim($_POST['email']) === '') {
		$emailError = apply_filters('reactor_contactform_error_email', '<small class="error">Please enter your email address.</small>');
		$errorClass = 'error';
		$hasError = true;
	} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
		$emailError = apply_filters('reactor_contactform_error_email_invalid', '<small class="error">You entered an invalid email address.</small>');
		$errorClass = 'error';
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}
	if (trim($_POST['comments']) === '') {
		$commentError = apply_filters('reactor_contactform_error_message', '<small class="error">Please enter a message.</small>');
		$errorClass = 'error';
		$hasError = true;
	} else {
		if (function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['comments']));
		} else {
			$comments = trim($_POST['comments']);
		}
	}
	if (!isset($hasError)) {
		$emailTo = get_option('tz_email');
		if (!isset($emailTo) || ($emailTo == '')) {
			$emailTo = apply_filters('reactor_contactform_emailto', $contact_email);
		}
		$subject = apply_filters('reactor_contactform_subject', $email_subject);
		$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
		$headers = 'From: ' . $name . ' <' . $emailTo . '>' . "\r\n" . 'Reply-To: ' . $email;
		wp_mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}

}*/ // end form validation
?>

<?php get_header(); ?>


	<div id="primary" class="site-content">

		<?php reactor_content_before(); ?>

		<div id="content" role="main">
			<div class="row">
				<div class="<?php reactor_columns(); ?>">

					<?php reactor_inner_content_before(); ?>
					<?php
					//Angularpress: just show the posts page content when "posts page is set in the reading settings.
					$page_id = get_queried_object_id();
					if (get_option('page_for_posts') != $page_id) {
						?>
						<?php // get the page loop
						get_template_part('loops/loop', 'page'); ?>

						<div class="row">

							<div id="contact-form"
							     class="<?php reactor_columns(12) ?> entry-content">
								<?php echo do_shortcode('[contact-form-7 id="162" title="Contact form 1"]'); ?>
								<!--								--><?php //if (isset($emailSent) && $emailSent == true) { ?>
								<!--									<div class="thanks">-->
								<!--										--><?php //echo apply_filters('reactor_contactform_success', $msg_sent); ?>
								<!--									</div>-->
								<!--								--><?php //} ?>
								<?php /*if (!isset($hasError)) {
									$nameError = '';
									$emailError = '';
									$commentError = '';
									$errorClass = '';
								} */
								?>
								<!--<form action="<?php /*the_permalink(); */ ?>" id="contactForm"
								      method="post"
								      class="nice">
									<div class="contact-form row">
										<div class="<?php /*reactor_columns(7) */ ?>">
											<label class="<?php /*echo $errorClass; */ ?>"
											       for="contactName">Name:</label>
											<input type="text" name="contactName" id="contactName"
											       value="<?php /*if (isset($_POST['contactName'])) echo $_POST['contactName']; */ ?>"
											       class="required <?php /*echo $errorClass; */ ?>"/>
											<?php /*if ($nameError != '') : */ ?>
												<span class="error"><?php /*echo $nameError; */ ?></span>
											<?php /*endif; */ ?>
										</div>

										<div class="<?php /*reactor_columns(7) */ ?>">
											<label class="<?php /*echo $errorClass; */ ?>"
											       for="email">Email </label>
											<input type="text" name="email" id="email"
											       value="<?php /*if (isset($_POST['email'])) echo $_POST['email']; */ ?>"
											       class="required email <?php /*echo $errorClass; */ ?>"/>
											<?php /*if ($emailError != '') : */ ?>
												<span
													class="error"><?php /*echo $emailError; */ ?></span>
											<?php /*endif; */ ?>
										</div>

										<div class="<?php /*reactor_columns(10) */ ?>">
											<label class="<?php /*echo $errorClass; */ ?>"
											       for="commentsText">Message:</label>
											<textarea name="comments" id="commentsText" rows="12"
											          cols="80"
											          class="required <?php /*echo $errorClass; */ ?>"><?php /*if (isset($_POST['comments'])) {
													if (function_exists('stripslashes')) {
														echo stripslashes($_POST['comments']);
													} else {
														echo $_POST['comments'];
													}
												} */
								?></textarea>
											<?php /*if ($commentError != '') : */ ?>
												<span
													class="error"><?php /*echo $commentError; */ ?></span>
											<?php /*endif; */ ?>
										</div>
										<div class="<?php /*reactor_columns(12) */ ?>">
											<input type="submit"
											       value="<?php /*echo apply_filters('reactor_contactform_submit', 'Send'); */ ?>"
											       class="button"/>
										</div>
									</div>
									<input type="hidden" name="submitted" id="submitted"
									       value="true"/>
								</form>-->
							</div>
							<!-- #contact-form .columns -->
						</div>
					<?php }; ?>
					<!-- .row -->

					<?php reactor_inner_content_after(); ?>

				</div>
				<!-- .columns -->

				<?php get_sidebar(); ?>

			</div>
			<!-- .row -->
		</div>
		<!-- #content -->

		<?php reactor_content_after(); ?>

	</div><!-- #primary -->

<?php get_footer(); ?>