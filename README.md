I. Angularpresstheme: Angularjs + Wordpress + Zurb Foundation
=============================================================

Angularjs, Wordpress and Zurb Foundation. This theme turns Wordpress into a Single Page Application.

II. Demo
========

[angularpresstheme.com](http://angularpresstheme.com/)


III. Configuration
==================

* Install [json api plugin](http://wordpress.org/plugins/json-api/) . Go to **settings/json
api** and activate all its components
* Set your permalink Custom Structure  to **/%category%/%postname%/**
* Check that category base and tag base are set to none or '/'. If your category base,
tag base or custom structure are structured like these:
        'http://yoursitename/blog' or '/blog'
   You'll need to configure angularjs routing in **library/app.js** as follows:

		**from**

		when('/', {

		**change to**

		when('/blog/', {

		**from**

		when('/:primaryNav/', {

		**change to**

		when('/blog/:primaryNav/', {

		**from**

		when('/:primaryNav/:secondaryNav/', {

		**change to**

		when('/blog/:primaryNav/:secondaryNav/', {



(cont.)
=========================
* You need php 5.3+ and your server **must** have **allow_url_fopen** set to on

* If you use multisite with WPMU DOMAIN MAPPING outdated plugin and WP 3.8 you should update it
 to the new version:

	>Multi-Domains for Multisite and Domain Mapping plugin or any other domain plugin that works with
> version 3.8.1 of wordpress

* If you use any type of maintenance plugin that redirects to 503 error page, you must deactivate it (this will be addressed in a future version)

* Check that your  angularpress/library/views is writable

IV. How to use It
================

Create a new page set a template and click publish.

V. Note about WP plugins
=========================


###Example:Contact form 7

put shortcode at line 90 on page-templates/contact.php
generate contact.html : go to pages and generate contact.html by clicking on update or publish

VI. Note about jQuery plugins
==============================


VII. Known bugs
================

* When embeding youtube videon on posts causes full page reload
* When post or page is new preview not working
* Rename post/page slug should not renaming angular template file
* Main Menu and Sidebar menu not working
* Reactor menu dont disappear when set visibility to private or state to pending or draft
* Cant go back from admin area to preview page/posts
* After close browser, sometimes redirection don't work anymore


VIII. Todo
==========

* Breadcrumbs
* Filters: category & archives
* Searchbar
* Publish page bulk action
* Comments form
* Contact form
* Porfolio subpages
* Update foundation components and shortcodes to boostrap-ui
* Title tag
* Gmail and Youtube like routing
* **WIP**- work in progress. Work offline and synch when back on. See John Papa's concept: [Code Camper](http://cc-ng-z.azurewebsites.net/#/sessions)
* Multisite compatible
* Update to foundation 5
* Views folder on a CDN
* WP option for angularjs routing: admin, login, category base etc
* States: pending & draft
* Visibility: set private & set password
* Use ob_start instead of HTTP_API
* Reading Settings: date and time format
* Responsive design: Work on phones
* SEO with Phantonjs
* Page formats
* Splash Screen for index
* Security
* Grunt
* Requirejs and r.js on theme build
* Woocommerce compatible
* Accessibility
* Child Theme




