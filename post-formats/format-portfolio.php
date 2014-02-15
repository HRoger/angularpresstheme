<?php
/**
 * The template for displaying posts on the portfolio page,
 * portfolio-single, taxonomy-portfolio-category and taxonomy-portfolio-tag
 *
 * @package Reactor
 * @subpackage Post-Formats
 * @since 1.0.0
 */
?>

<?php
/** @noinspection PhpParamsInspection */
$show_titles = reactor_option('portfolio_show_titles', 1);
/** @noinspection PhpParamsInspection */
$link_titles = reactor_option('portfolio_link_titles', 1);
/** @noinspection PhpParamsInspection */
$post_meta = reactor_option('portfolio_post_meta', 0); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-body">
		<header class="entry-header">
			<?php if (has_post_thumbnail() && !is_single()) : ?>

				<div class="entry-thumbnail">
					<!--<a  href="<?php /*the_permalink() */ ?>" rel="bookmark" title="<?php /*the_title_attribute(); */ ?>"><?php /*the_post_thumbnail(); */ ?></a>-->
					<a class="fancybox" fancybox rel="gallery1"
					   href="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large', false)[0]; ?>"
					   rel="bookmark"
					   title="<?php the_title_attribute(); ?>"><?php   the_post_thumbnail('medium');
						?></a>
				</div>

			<?php endif; ?>

			<?php if ($show_titles && !is_single()) : ?>
				<?php if ($link_titles) : ?>
					<h2 class="entry-title portfolio">

						<!--   <a  href="<?php /*the_permalink(); */ ?>" title="<?php /*echo esc_attr( sprintf(  __('%s', 'reactor'), the_title_attribute('echo=0') ) ); */ ?>" rel="bookmark"><?php /*the_title(); */ ?></a> -->
						<a href="#"
						   title="<?php echo esc_attr(sprintf(__('%s', 'reactor'), the_title_attribute('echo=0'))); ?>"
						   rel="bookmark"><?php the_title(); ?></a>
					</h2>
				<?php else : ?>
					<h2 class="entry-title portfolio">
						<!--                        --><?php //the_title(); ?>
						<div ng-bind-html="item.title"></div>
					</h2>
				<?php endif; endif; ?>
			<?php if (is_single()) : ?>
				<h2 class="entry-title">
					<!--                        --><?php //the_title(); ?>
					<div ng-bind-html="item.title"></div>
				</h2>
			<?php endif; ?>
		</header>
		<!-- .entry-header -->

		<?php if (is_single()) : ?>
			<div class="entry-content">
				<?php the_content(); ?>
				<!--	            <div ng-bind-html="item.content"></div>-->
			</div><!-- .entry-content -->
		<?php endif; ?>

		<footer class="entry-footer">
			<?php if ($post_meta && !is_single()) : reactor_post_meta(); ?>
			<?php else : if (is_single()) : reactor_post_meta(); endif; endif; ?>
		</footer>
		<!-- .entry-footer -->
	</div>
	<!-- .entry-body -->
</article><!-- #post -->