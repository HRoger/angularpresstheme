<?php 
/**
 * The sidebar template containing the footer widget area
 * @package Angularpress
 * @package Reactor
 * @subpackge Templates
 * @since 1.0.0
 */
?>
		<?php if ( is_active_sidebar('sidebar-footer') ) : ?>
            <div class="row">
                <div class="<?php reactor_columns( 12 ); ?>">
                    <div id="sidebar-footer" class="sidebar" role="complementary"
                         data-ng-controller="SidebarFooterCtrl">

		                    <widget-footer name="sidebar-footer"></widget-footer>

                    </div><!-- #sidebar-footer -->
                </div><!--.columns -->   
            </div><!-- .row -->
		<?php endif; ?>

