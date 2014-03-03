/**
 * Created by ROGER on 25.01.14.
 */
'use strict';
angularpressApp.filter('fromUrlSlugToTitle', function () {

	String.prototype.formatSlug = function () {
		return this.slice(this.lastIndexOf('/', this.length - 2), -1).replace('/', '');
	};
	String.prototype.capitalize = function () {
		return this.charAt(0).toUpperCase() + this.slice(1);
	};

	//noinspection FunctionWithInconsistentReturnsJS
	return function (slug) {

		if (slug !== undefined) {

			var formattedSlug = slug.formatSlug();
			var arrayOfStrings = formattedSlug.split("-");
			var splitedSlug = '';

			for (var i = 0; i < arrayOfStrings.length; i++) {

				splitedSlug += ' ' + arrayOfStrings[i].capitalize();
			}

			return splitedSlug;

		}

	};
});

