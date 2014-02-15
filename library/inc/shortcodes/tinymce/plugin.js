(function ()
{
	// create reactorShortcodes plugin
	tinymce.create("tinymce.plugins.reactorShortcodes",
	{
		init: function ( ed, url )
		{
			ed.addCommand("reactorPopup", function ( a, params )
			{
				var popup = params.identifier;
				
				// load thickbox
				tb_show("Insert Reactor Shortcode", url + "/popup.php?popup=" + popup + "&width=" + 800);
			});
		},
		createControl: function ( btn, e )
		{
			if ( btn == "reactor_button" )
			{	
				var a = this;
				
				var btn = e.createSplitButton('reactor_button', {
                    title: "Insert Reactor Shortcode",
					image: ReactorShortcodes.theme_folder +"/tinymce/images/icon.png",
					icons: false
                });

                btn.onRenderMenu.add(function ( c, b )
				{					
					a.addWithPopup( b, "Alert", "alert" );
					a.addWithPopup( b, "Button", "button" );
					a.addWithPopup( b, "Columns", "columns" );
					a.addWithPopup( b, "Flex Video", "flex_video" );
					a.addWithPopup( b, "Glyph Icon", "glyph_icon" );
					a.addWithPopup( b, "Label", "label" );
					a.addWithPopup( b, "Panel", "panel" );
					a.addWithPopup( b, "Price Table", "price_table" );
					a.addWithPopup( b, "Progress Bar", "progress_bar" );
					a.addWithPopup( b, "Reveal Modal", "reveal_modal" );
					a.addWithPopup( b, "Sections", "sections" );
					a.addWithPopup( b, "Tooltip", "tooltip" );
				});
                
                return btn;
			}
			
			return null;
		},
		addWithPopup: function ( ed, title, id ) {
			ed.add({
				title: title,
				onclick: function () {
					tinyMCE.activeEditor.execCommand("reactorPopup", false, {
						title: title,
						identifier: id
					})
				}
			})
		},
		addImmediate: function ( ed, title, sc) {
			ed.add({
				title: title,
				onclick: function () {
					tinyMCE.activeEditor.execCommand( "mceInsertContent", false, sc )
				}
			})
		},
		getInfo: function () {
			return {
				longname: 'Reactor Shortcodes',
				author: 'Orman Clark',
				authorurl: 'http://themeforest.net/user/ormanclark/',
				infourl: 'http://wiki.moxiecode.com/',
				version: "1.0.0"
			}
		}
	});
	
	// add reactorShortcodes plugin
	tinymce.PluginManager.add("reactorShortcodes", tinymce.plugins.reactorShortcodes);
})();
