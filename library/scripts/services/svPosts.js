/**
 * Created by ROGER on 16.12.13.
 */
'use strict';

angularpressApp.factory('post', function ($http, $angularCacheFactory, wpAjax, $cacheFactory) {
	if (wpAjax.authentication.is_user_logged_in === '') {
		if (wpAjax.sessions.on_first_page_load === null) {

			var postCache = $angularCacheFactory('postCache', {
				maxAge            : 900000,
				deleteOnExpire    : 'aggressive',
				storageMode       : 'localStorage',
				recycleFreq       : 10000,
				cacheFlushInterval: 3600000,
				verifyIntegrity   : true
			});

			if (wpAjax.sessions.angp_session_delete_post_cache_key !== null) {
				postCache.removeAll();
			}
		}
	} else {
		postCache = $cacheFactory('postCache');
	}

	return{

		get_post_ID: function (successcb, slug) {
			$http(
				{
					method: 'GET',
					cache : postCache,
					url   : wpAjax.themeLocation.siteUrl + '/api/',
					params: {
						json       : 'get_post',
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

		get_all_posts               : function (successcb) {

			$http(
				{
					method: 'GET',
					cache : postCache,
					url   : wpAjax.themeLocation.siteUrl + '/api/',
					params: {
						json       : 'get_posts',
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
		get_post_pagination         : function (successcb, status, page) {

			$http(
				{
					method: 'GET',
					cache : postCache,
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
		get_post_pagination_category: function (successcb, status, slug, page) {

			$http(
				{
					method: 'GET',
					cache : postCache,
					url   : wpAjax.themeLocation.siteUrl + '/api/',
					params: {
						json       : 'get_category_posts',
						status     : status,
						slug       : slug,
						page       : page,
						date_format: 'F j, Y'
					}
				})
				.success(function (data) {
					return successcb(data);

				})
				.error(function () {
					if (wpAjax.sessions.on_first_page_load === null)
						throw new Error('Network error. Post category not loaded.');
				})

		},
		get_post_pagination_tag     : function (successcb, status, slug, page) {

			$http(
				{
					method: 'GET',
					cache : postCache,
					url   : wpAjax.themeLocation.siteUrl + '/api/',
					params: {
						json       : 'get_tag_posts',
						status     : status,
						slug       : slug,
						page       : page,
						date_format: 'F j, Y'
					}
				})
				.success(function (data) {
					return successcb(data);

				})
				.error(function () {
					if (wpAjax.sessions.on_first_page_load === null)
						throw new Error('Network error. Post tag not loaded.');
				})

		},
		get_post_pagination_archive : function (successcb, status, year, date, page) {

			$http(
				{
					method: 'GET',
					cache : postCache,
					url   : wpAjax.themeLocation.siteUrl + '/api/',
					params: {
						json       : 'get_date_posts',
						status     : status,
						date       : '/' + year + '/' + date + '/',
						page       : page,
						date_format: 'F j, Y'
					}
				})
				.success(function (data) {
					return successcb(data);

				})
				.error(function () {
					if (wpAjax.sessions.on_first_page_load === null)
						throw new Error('Network error. Post date not loaded.');
				})

		},
		get_portfolio_post          : function (successcb, slug) {
			$http(
				{
					method: 'GET',
					cache : postCache,
					url   : wpAjax.themeLocation.siteUrl + '/api/portfolio/get_portfolio_post/',
					params: {
						slug: slug
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
		}
	}

});