<?php
/**
 * The sidebar template containing the front page widget area
 *
 * @package Reactor
 * @subpackge Templates
 * @since 1.0.0
 */
?>

<?php // get the front page layout
wp_reset_postdata();
/** @noinspection PhpParamsInspection */
$layout = reactor_option('', '1c', '_template_layout'); ?>

<?php // if front page has one sidebar and the sidebar is active
if (is_active_sidebar('sidebar-frontpage') && '1c' != $layout) : ?>

	<?php reactor_sidebar_before(); ?>

	<div id="sidebar-frontpage" class="sidebar <?php reactor_columns('', true, true, 1); ?>"
	     role="complementary" data-ng-controller="SidebarFrontpageCtrl">

		<widget-sidebar name="sidebar-frontpage"></widget-sidebar>

	</div><!-- #sidebar-frontpage -->

<?php // else show an alert
else : if ('1c' != $layout) : ?>

	<div id="sidebar-frontpage" class="sidebar <?php reactor_columns('', true, true, 1); ?>"
	     role="complementary">
		<div class="alert-box secondary">
			<p>Add some widgets to this area!</p>
		</div>
	</div><!-- #sidebar -->

	<?php reactor_sidebar_after(); ?>

<?php endif; endif; ?>

<?php // if front page has two sidebars and second sidear is active
if (is_active_sidebar('sidebar-frontpage-2') && ('3c-l' == $layout || '3c-r' == $layout || '3c-c' == $layout)) : ?>

	<?php reactor_sidebar_before(); ?>

	<div id="sidebar-frontpage-2" class="sidebar <?php reactor_columns('', true, true, 2); ?>"
	     role="complementary" data-ng-controller="SidebarFrontpageCtrl">

		<widget-sidebar name="sidebar-frontpage-2"></widget-sidebar>

	</div>

<?php // else show an alert
else : if ('3c-l' == $layout || '3c-r' == $layout || '3c-c' == $layout) : ?>

	<div id="sidebar-frontpage-2" class="sidebar <?php reactor_columns('', true, true, 2); ?>"
	     role="complementary">
		<div class="alert-box secondary">
			<p>Add some widgets to this area!</p>
		</div>
	</div><!-- #sidebar-2 -->

	<?php reactor_sidebar_after(); ?>

<?php endif; endif; ?>