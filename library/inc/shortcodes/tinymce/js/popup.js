
// start the popup specefic scripts
// safe to use $
jQuery(document).ready(function($) {
    var reactors = {
    	loadVals: function()
    	{
    		var shortcode = $('#_reactor_shortcode').text(),
    			uShortcode = shortcode;
    		
    		// fill in the gaps eg {{param}}
    		$('.reactor-input').each(function() {
    			var input = $(this),
    				id = input.attr('id'),
    				id = id.replace('reactor_', ''),		// gets rid of the reactor_ prefix
    				re = new RegExp("{{"+id+"}}","g");
    				
    			uShortcode = uShortcode.replace(re, input.val());
    		});
    		
    		// adds the filled-in shortcode as hidden input
    		$('#_reactor_ushortcode').remove();
    		$('#reactor-sc-form-table').prepend('<div id="_reactor_ushortcode" class="hidden">' + uShortcode + '</div>');
    	},
    	cLoadVals: function()
    	{
    		var shortcode = $('#_reactor_cshortcode').text(),
    			pShortcode = '';
    			shortcodes = '';
    		
    		// fill in the gaps eg {{param}}
    		$('.child-clone-row').each(function() {
    			var row = $(this),
    				rShortcode = shortcode;
    			
    			$('.reactor-cinput', this).each(function() {
    				var input = $(this),
    					id = input.attr('id'),
    					id = id.replace('reactor_', '')		// gets rid of the reactor_ prefix
    					re = new RegExp("{{"+id+"}}","g");
    					
    				rShortcode = rShortcode.replace(re, input.val());
    			});
    	
    			shortcodes = shortcodes + rShortcode + "\n";
    		});
    		
    		// adds the filled-in shortcode as hidden input
    		$('#_reactor_cshortcodes').remove();
    		$('.child-clone-rows').prepend('<div id="_reactor_cshortcodes" class="hidden">' + shortcodes + '</div>');
    		
    		// add to parent shortcode
    		this.loadVals();
    		pShortcode = $('#_reactor_ushortcode').text().replace('{{child_shortcode}}', shortcodes);
    		
    		// add updated parent shortcode
    		$('#_reactor_ushortcode').remove();
    		$('#reactor-sc-form-table').prepend('<div id="_reactor_ushortcode" class="hidden">' + pShortcode + '</div>');
    	},
    	children: function()
    	{
    		// assign the cloning plugin
    		$('.child-clone-rows').appendo({
    			subSelect: '> div.child-clone-row:last-child',
    			allowDelete: false,
    			focusFirst: false
    		});
    		
    		// remove button
    		$('.child-clone-row-remove').on('click', function() {
    			var	btn = $(this),
    				row = btn.parent();
    			
    			if( $('.child-clone-row').size() > 1 )
    			{
    				row.remove();
    			}
    			else
    			{
    				alert('You need a minimum of one row');
    			}
    			
    			return false;
    		});
    		
    		// assign jUI sortable
    		$( ".child-clone-rows" ).sortable({
				placeholder: "sortable-placeholder",
				items: '.child-clone-row'
				
			});
    	},
    	resizeTB: function()
    	{
			var	ajaxCont = $('#TB_ajaxContent'),
				tbWindow = $('#TB_window'),
				reactorPopup = $('#reactor-popup');

            tbWindow.css({
               // height: reactorPopup.outerHeight() + 50,
                width: reactorPopup.outerWidth() + 20,
                marginLeft: -(reactorPopup.outerWidth()/2)
            });

			ajaxCont.css({
				paddingTop: 0,
				paddingLeft: 0,
				paddingRight: 0,
				height: (tbWindow.outerHeight()-47),
				overflow: 'auto', // IMPORTANT
				width: reactorPopup.outerWidth() + 20
			});
			
			$('#reactor-popup').addClass('no_preview');
    	},
    	load: function()
    	{
    		var	reactors = this,
    			popup = $('#reactor-popup'),
    			form = $('#reactor-sc-form', popup),
    			shortcode = $('#_reactor_shortcode', form).text(),
    			popupType = $('#_reactor_popup', form).text(),
    			uShortcode = '';
    		
    		// resize TB
    		reactors.resizeTB();
    		$(window).resize(function() { reactors.resizeTB() });
    		
    		// initialise
    		reactors.loadVals();
    		reactors.children();
    		reactors.cLoadVals();
    		
    		// update on children value change
    		$('.reactor-cinput', form).live('change', function() {
    			reactors.cLoadVals();
    		});
    		
    		// update on value change
    		$('.reactor-input', form).change(function() {
    			reactors.loadVals();
    		});
    		
    		// when insert is clicked
    		$('.reactor-insert', form).on('click', function() {    		 			
    			if(window.tinyMCE)
				{
					window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, $('#_reactor_ushortcode', form).html());
					tb_remove();
				}
    		});
    	}
	}
    
    // run
    $('#reactor-popup').livequery( function() { reactors.load(); } );
});