<?php
/**
 * The sidebar template containing the main widget area
 *
 * @package Reactor
 * @subpackge Templates
 * @since 1.0.0
 */
?>
<?php // get the page layout
wp_reset_postdata();
/** @noinspection PhpParamsInspection */
$default = reactor_option('page_layout', '2c-l');
/** @noinspection PhpParamsInspection */
$layout = reactor_option('', $default, '_template_layout'); ?>

<?php // if layout has one sidebar and the sidebar is active
if (is_active_sidebar('sidebar') && '1c' != $layout) : ?>

	<?php reactor_sidebar_before(); ?>

	<div id="sidebar" class="sidebar <?php reactor_columns('', true, true, 1); ?>"
	     role="complementary" data-ng-controller="SidebarCtrl">

		<widget-sidebar  name="sidebar"></widget-sidebar>

	</div>
	<!-- #sidebar -->

<?php // else show an alert
else : if ('1c' != $layout) : ?>

	<div id="sidebar" class="sidebar <?php reactor_columns('', true, true, 1); ?>"
	     role="complementary" data-ng-controller="SidebarCtrl">
		<div class="alert-box secondary">
			<p>Add some widgets to this area!</p>
		</div>
	</div>
	<!-- #sidebar -->

	<?php reactor_sidebar_after(); ?>

<?php endif; endif; ?>

<?php // if layout has two sidebars and second sidear is active
if (is_active_sidebar('sidebar-2') && ('3c-l' == $layout || '3c-r' == $layout || '3c-c' == $layout)) : ?>

	<?php reactor_sidebar_before(); ?>

	<div id="sidebar-2" class="sidebar <?php reactor_columns('', true, true, 2); ?>"
	     role="complementary" data-ng-controller="SidebarCtrl">

		<widget-sidebar  name="sidebar-2"></widget-sidebar>

	</div>
	<!-- #sidebar-2 -->

<?php // else show an alert
else : if ('3c-l' == $layout || '3c-r' == $layout || '3c-c' == $layout) : ?>

	<div id="sidebar-2" class="sidebar <?php reactor_columns('', true, true, 2); ?>"
	     role="complementary" >
		<div class="alert-box secondary">
			<p>Add some widgets to this area!</p>
		</div>
	</div>
	<!-- #sidebar-2 -->

	<?php reactor_sidebar_after(); ?>

<?php endif; endif; ?>