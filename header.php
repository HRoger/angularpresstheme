<?php
/**
 * The template for displaying the header
 *
 * @package Reactor
 * @subpackge Templates
 * @since 1.0.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>  data-ng-controller="MainCtrl"   data-ng-app="angularpressApp">


<head>
	<!-- WordPress head -->
	<?php wp_head(); ?>
	<!-- end WordPress head -->
	<?php reactor_head(); ?>
</head>

<body  id="{{$route.current.scope.menuId}}" <?php
(get_option('page_for_posts')!=0) ? $page_for_posts_class = ' page_for_posts': $page_for_posts_class ='';
body_class('{{$route.current.scope.menuId}} {{$route.current.scope.pageId}}'.$page_for_posts_class);
?> >

<?php reactor_body_inside(); ?>

<div id="page" class="hfeed site">

	<?php reactor_header_before(); ?>

	<header   id="header" class="site-header" role="banner">
		<div class="row">
			<div class="<?php reactor_columns(12); ?>">

				<?php reactor_header_inside(); ?>

			</div>
			<!-- .columns -->
		</div>
		<!-- .row -->
	</header>
	<!-- #header -->

	<?php reactor_header_after(); ?>

	<div id="main" class="wrapper">
		<content>