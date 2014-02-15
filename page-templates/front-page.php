<?php
/**
 * Template Name: Front Page
 *
 * @package Reactor
 * @subpackge Page-Templates
 * @since 1.0.0
 */
update_option('current_page_template', 'front-page');
?>

<?php // get the options
/** @noinspection PhpParamsInspection */
$slider_category = reactor_option('frontpage_slider_category', ''); ?>

<?php get_header(); ?>


<div id="primary" class="site-content">

	<?php reactor_content_before(); ?>

	<div class="row">
		<div class="<?php reactor_columns(12); ?>">
			<?php // slider function passing category from options
			reactor_slider(array(
				'category' => $slider_category,
				'slider_id' => 'slider-front-page',
				'data_options' => array(
					'animation' => '\'fade\'',
					'pause_on_hover' => 'false',
				),
			)); ?>
		</div>
		<!-- .columns -->
	</div>
	<!-- .row -->

	<div ng-cloak id="content" role="main">
		<div class="row">
			<?php
			$page_id = get_queried_object_id();
			if (get_option('page_for_posts') != $page_id) {

			?>
			<div class="<?php reactor_columns(); ?>">

				<?php reactor_inner_content_before(); ?>

				<?php // get the page loop

				get_template_part('loops/loop', 'page'); ?>

				<?php // get the main loop
				get_template_part('loops/loop', 'frontpage'); ?>
				<?php }; ?>
				<?php reactor_inner_content_after(); ?>

			</div>

			<!-- .columns -->
			<?php get_sidebar('frontpage'); ?>
		</div>
		<!-- .row -->
	</div>
	<!-- #content -->

	<?php reactor_content_after(); ?>

</div><!-- #primary -->

<?php get_footer(); ?>