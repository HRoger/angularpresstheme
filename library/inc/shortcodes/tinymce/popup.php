<?php

// loads the shortcodes class, wordpress is loaded with it
require_once( 'shortcodes.class.php' );

// get popup type
$popup = trim( $_GET['popup'] );
$shortcode = new reactor_shortcodes( $popup );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head></head>
<body>
<div id="reactor-popup">

	<div id="reactor-shortcode-wrap">
		
		<div id="reactor-sc-form-wrap">
		
			<div id="reactor-sc-form-head">
			
				<?php echo $shortcode->popup_title; ?>
			
			</div>
			<!-- /#reactor-sc-form-head -->
			
			<form method="post" id="reactor-sc-form">
			
				<table id="reactor-sc-form-table">
				
					<?php echo $shortcode->output; ?>
					
					<tbody>
						<tr class="form-row">
							<?php if( ! $shortcode->has_child ) : ?><td class="label">&nbsp;</td><?php endif; ?>
							<td class="field"><a href="#" class="button-primary reactor-insert"><?php _e('Insert Shortcode', 'reactor'); ?></a></td>							
						</tr>
					</tbody>
				
				</table>
				<!-- /#reactor-sc-form-table -->
				
			</form>
			<!-- /#reactor-sc-form -->
		
		</div>
		<!-- /#reactor-sc-form-wrap -->
		
		<div class="clear"></div>
		
	</div>
	<!-- /#reactor-shortcode-wrap -->

</div>
<!-- /#reactor-popup -->

</body>
</html>