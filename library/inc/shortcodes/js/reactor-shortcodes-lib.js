jQuery(document).ready(function($) {

	$(".reactor-tabs").tabs();
	
	$(".reactor-toggle").each( function () {
		if($(this).attr('data-id') == 'closed') {
			$(this).accordion({ header: '.reactor-toggle-title', collapsible: true, active: false  });
		} else {
			$(this).accordion({ header: '.reactor-toggle-title', collapsible: true});
		}
	});
	
	
});