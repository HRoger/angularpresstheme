<?php
/**
 * The template for displaying the search form
 *
 * @package Reactor
 * @subpackge Templates
 * @since 1.0.0
 */
?>

<form role="search" method="get" id="searchform" action="<?php echo home_url(); ?>">
	<div class="row collapse">
		<label class="screen-reader-text" for="s"><?php _e('Search for:', 'reactor'); ?></label>
		<div class="<?php reactor_columns( array(9, 9) ) ?>">
			<input data-ng-model="searchText" type="text" value="<?php get_search_query(); ?>" name="s" id="s" placeholder="<?php echo esc_attr__('Search', 'reactor'); ?>" />
		</div>
		<div class="<?php reactor_columns( array(3, 3) ) ?> end">
			<input data-ng-click="test()" class="button prefix" type="submit" id="searchsubmit" value="<?php echo esc_attr__('Clear', 'reactor'); ?>" />
		</div>
	</div>
</form>