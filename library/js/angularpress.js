/* Reactor - Anthony Wilhelm - http://awtheme.com/ */
'use strict';
(function ($, document) {

	$(document).ready(function () {

		/* adds .button class to submit button on comment form */
		$('#commentform').find('input#submit').addClass('button').addClass('small');

		/* adjust site for fixed top-bar with wp admin bar */
		if ($('body').hasClass('admin-bar') && $('.top-bar').parent().hasClass('fixed')) {

			if ($(this).hasClass('has-top-bar')) {
				$('.top-bar').parent().css('margin-top', "+=28");
			}

			$(this).css('padding-top', "+=28");
		}

		/* prevent default if menu links are # */
		$('nav a').each(function () {
			var nav = $(this);
			if (nav.attr('href') === '#') {
				$(this).on('click', function (e) {
					e.preventDefault();
				});
			}
		});

	});
	/* end $(document).ready */

	/* Off Canvas */
	var events = 'click.fndtn',
		selector = $('#mobileMenuButton');
	if (selector.length > 0) {
		$('#mobileMenuButton').on(events, function (e) {
			e.preventDefault();
			$('body').toggleClass('active');
		});
	}

	$.fn.wpcf7 = function () {
		$.ajaxSetup({
			cache: true
		});

		$.getScript(Angularpress.url + "/wp-content/plugins/contact-form-7/includes/js/scripts.js", function (data, textStatus, jqxhr) {
			/*	console.info(data); // Data returned
			 console.info(textStatus); // Success
			 console.info(jqxhr.status); // 200
			 console.info("Load was performed.");*/
			//			return data;
		})

	}

	//Spinerjs
	$.fn.spin = function (opts, color) {
		var presets = {
			"tiny"          : { lines: 8, length: 0, width: 2, radius: 3 },
			"small"         : { lines: 8, length: 0, width: 3, radius: 4, top: 5 },
			"small-editlink": { lines: 8, length: 0, width: 3, radius: 4, left: 0 },
			"large"         : { lines: 10, length: 0, width: 4, radius: 6, top: 25 },
			"large-widgets" : { lines: 10, length: 0, width: 4, radius: 6, top: 5 }
		};
		if (Spinner) {
			return this.each(function () {
				var $this = $(this),
					data = $this.data();
				if (data.spinner) {
					data.spinner.stop();
					delete data.spinner;
				}
				if (opts !== false) {
					if (typeof opts === "string") {
						if (opts in presets) {
							opts = presets[opts];
						} else {
							opts = {};
						}
						if (color) {
							opts.color = color;
						}
					}
					data.spinner = new Spinner($.extend({color: $this.css('color')}, opts)).spin(this);
				}
			});
		} else {
			throw "Spinner class not available.";
		}
	};

})(jQuery);