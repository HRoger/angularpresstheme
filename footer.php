<?php
/**
 * The template for displaying the footer
 *
 * @package Reactor
 * @subpackge Templates
 * @since 1.0.0
 */
?>
</content>

<?php reactor_footer_before(); ?>

<footer data-ng-cloak id="footer" class="site-footer"
        role="contentinfo">

	<?php reactor_footer_inside(); ?>

</footer><!-- #footer -->

<?php reactor_footer_after(); ?>

</div><!-- #main -->
</div><!-- #page -->


<?php
wp_footer();
reactor_foot(); ?>
<a class="show-for-large-up" href="https://github.com/HRoger/angularpresstheme"
   target="_blank"><img
		style="position: absolute; top: 0; right: 0; border: 0;"
		src="https://github-camo.global.ssl.fastly.net/38ef81f8aca64bb9a64448d0d70f1308ef5341ab/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f6461726b626c75655f3132313632312e706e67"
		alt="Fork me on GitHub"
		data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png"></a>
</body>
</html>