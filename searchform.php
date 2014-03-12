<?php
/**
 * The template for displaying the search form
 *
 * @package Reactor
 * @subpackge Templates
 * @since 1.0.0
 */
?>

<form id="searchform" data-ng-submit="submit()">
	<div class="row collapse">
		<label class="screen-reader-text" for="s"><?php _e('Search for:', 'reactor'); ?></label>

		<div class="<?php reactor_columns(array(9, 9)) ?>">
			<input data-ng-model="text" type="text" name="s" id="s" placeholder="<?php echo
			esc_attr__('Search', 'reactor'); ?>"/>
		</div>
		<div class="<?php reactor_columns(array(3, 3)) ?> end">
			<button class="button prefix"
			        type="submit"><?php echo esc_attr__('Search', 'reactor'); ?>
			</button>
		</div>
	</div>
</form>



