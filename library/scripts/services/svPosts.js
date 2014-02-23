/**
 * Created by ROGER on 16.12.13.
 */
'use strict';

angularpressApp.factory('post', function ($http, $angularCacheFactory, wpAjax) {
	var postCache = $angularCacheFactory('postCache', {storageMode: 'localStorage'});
	return{

		get_post_ID: function (successcb, slug) {
			$http(
				{
					method: 'GET',
//					cache : true,
					url   : wpAjax.themeLocation.siteUrl + '/api/get_post/',
					params: {
						slug       : slug,
						date_format: 'F j, Y'
					}
				})
				.success(function (data) {
					return successcb(data);

				})
				.error(function () {
					if (wpAjax.sessions.on_first_page_load === null)
					//if something went wrong after the first page load throw error
					throw new Error('Network error. PageID factory not loaded.');

				})
		},

		get_all_posts      : function (successcb) {

			$http(
				{
					method: 'GET',
//					cache : true,
					url   : wpAjax.themeLocation.siteUrl + '/api/get_posts/',
					params: {
						date_format: 'F j, Y'
					}

				})
				.success(function (data) {
					return successcb(data);

				})
				.error(function () {
					if (wpAjax.sessions.on_first_page_load === null)
					throw new Error('Network error. Post factory not loaded.');
				})

		},
		get_post_pagination: function (successcb, status, page) {

			$http(
				{
					method: 'GET',
//					cache : true,
					url   : wpAjax.themeLocation.siteUrl + '/api/',
					params: {
						json       : 'get_posts',
						status     : status,
						page       : page,
						date_format: 'F j, Y'
					}
				})
				.success(function (data) {
					return successcb(data);

				})
				.error(function () {
					if (wpAjax.sessions.on_first_page_load === null)
					throw new Error('Network error. Post pagination not loaded.');
				})

		},
		get_post_category  : function (successcb, status, slug) {

			$http(
				{
					method: 'GET',
					cache : true,
					url   : wpAjax.themeLocation.siteUrl + '/api/',
					params: {
						json       : 'get_category_posts',
						status     : status,
						slug       : slug,
						date_format: 'F j, Y'
					}
				})
				.success(function (data) {
					return successcb(data);

				})
				.error(function () {
					if (wpAjax.sessions.on_first_page_load === null)
					throw new Error('Network error. Post pagination not loaded.');
				})

		}

	}

});

