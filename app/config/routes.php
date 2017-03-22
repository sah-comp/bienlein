<?php
/**
 * Cinnebar.
 *
 * @package Cinnebar
 * @subpackage Routes
 * @author $Author$
 * @version $Id$
 */

/**
 * Change the default language and continue with other routes.
 *
 * @todo maybe use language bean? What should happen if a unknown/inactive lang is requested?
 */
Flight::route('(/@language:[a-z]{2})/*', function($language) {
    if (in_array($language, Flight::get('possible_languages'))) {
        Flight::set('language', $language);
    }
    return true;
});

/**
 * Top level url routes to either '/' domain or the welcome controller jumps in.
 */

Flight::route('(/[a-z]{2})/', function() {
    if (Flight::setting()->homepage) {
        $cmsController = new Controller_Cms();
    	$cmsController->frontend(R::load('domain', Flight::setting()->homepage));
    }
    else
    {
	    $welcomeController = new Controller_Welcome();
	    $welcomeController->index();
	}
});

/**
 * Routes to the login/logout controllers.
 */
Flight::route('(/[a-z]{2})/login', function() {
	$loginController = new Controller_Login();
	$loginController->index();
});
Flight::route('(/[a-z]{2})/logout', function() {
	$logoutController = new Controller_Logout();
	$logoutController->index();
});

/**
 * Routes to lostpassword controller.
 */
 Flight::route('(/[a-z]{2})/lostpassword', function() {
 	$lostpasswordController = new Controller_Lostpassword();
 	$lostpasswordController->index();
 });

/**
 * Routes to the admin controller.
 */
Flight::route('(/[a-z]{2})/admin(/index)', function() {
	$adminController = new Controller_Admin();
	$adminController->index();
});


/**
 * Routes to the scaffold controller.
 *
 * These routes will handle all models in a basic CURD way.
 */
Flight::route('(/[a-z]{2})/admin/@type:[a-z]+/add(/@id:[0-9]+)(/@layout:[a-z]+)', function($type, $id, $layout) {
    if ($layout === null) $layout = 'table';
 	$scaffoldController = new Controller_Scaffold('/admin', $type, $id);
 	$scaffoldController->add($layout);
 });
Flight::route('(/[a-z]{2})/admin/@type:[a-z]+/edit/@id:[0-9]+(/@page:[0-9]+)(/@order:[0-9]+)(/@dir:[0-1]{1})(/@layout:[a-z]+)', function($type, $id, $page, $order, $dir, $layout) {
    if ($layout === null) $layout = 'table';
    if ($page === null) $page = 1;
    if ($order === null) $order = 0;
    if ($dir === null) $dir = 0;
	$scaffoldController = new Controller_Scaffold('/admin', $type, $id);
	$scaffoldController->edit($page, $order, $dir, $layout);
});
Flight::route('(/[a-z]{2})/admin/@type:[a-z]+(/@layout:[a-z]+)(/@page:[0-9]+)(/@order:[0-9]+)(/@dir:[0-1]{1})', function($type, $layout, $page, $order, $dir) {
    if ($layout === null) $layout = 'table';
    if ($page === null) $page = 1;
    if ($order === null) $order = 0;
    if ($dir === null) $dir = 0;
	$scaffoldController = new Controller_Scaffold('/admin', $type);
	$scaffoldController->index($layout, $page, $order, $dir);
});
Flight::route('(/[a-z]{2})/admin/@type:[a-z]+/detach/@subtype:[a-z]+(/@id:[0-9]+)', function($type, $subtype, $id) {
    if ($id === null) $id = 0;
	$scaffoldController = new Controller_Scaffold('/admin', $type, $id);
	$scaffoldController->detach($subtype, $id);
});
Flight::route('(/[a-z]{2})/admin/@type:[a-z]+/attach/@prefix:[a-z]+/@subtype:[a-z]+(/@id:[0-9]+)', function($type, $prefix, $subtype, $id) {
    if ($id === null) $id = 0;
	$scaffoldController = new Controller_Scaffold('/admin', $type, $id);
	$scaffoldController->attach($prefix, $subtype, $id);
});

/**
 * Routes to the cms controller.
 */
Flight::route('(/[a-z]{2})/cms(/index)', function() {
	$cmsController = new Controller_Cms();
	$cmsController->index();
});

Flight::route('(/[a-z]{2})/cms/sitemap', function() {
    $layout = 'table';
    $page = 1;
    $order = 0;
    $dir = 0;
	$scaffoldController = new Controller_Nested();
	$scaffoldController->index();
});

/**
 * Routes to the cms controller to add a new domain.
 */
Flight::route('POST (/[a-z]{2})/cms/add/@type:[a-z]+', function($type) {
	$cmsController = new Controller_Cms();
	$cmsController->add($type);
});

/**
 * Routes to the cms controller to arrange (sort) beans.
 */
Flight::route('(/[a-z]{2})/cms/sortable/@type:[a-z]+/@var:[a-z]+', function($type, $var) {
	$cmsController = new Controller_Cms();
	$cmsController->sortable($type, $var);
});

/**
 * Routes to the cms controller to view a domain node.
 */
Flight::route('(/[a-z]{2})/cms/node/@id:[0-9]+(/@page_id:[0-9]+)', function($id, $page_id) {
	$cmsController = new Controller_Cms();
	$cmsController->node($id, $page_id);
});

/**
 * Routes to the cms controller to update the meta information of a page.
 */
Flight::route('POST (/[a-z]{2})/cms/meta/@id:[0-9]+', function($id) {
	$cmsController = new Controller_Cms();
	$cmsController->meta($id);
});

/**
 * Routes to the cms controller to view a page.
 */
Flight::route('(/[a-z]{2})/cms/page/@id:[0-9]+', function($id) {
	$cmsController = new Controller_Cms();
	$cmsController->page($id);
});

/**
 * Routes to the cms controller to edit a slice.
 */
Flight::route('(/[a-z]{2})/cms/slice/@id:[0-9]+', function($id) {
	$cmsController = new Controller_Cms();
	$cmsController->slice($id);
});

/**
 * Routes to the scaffold controller for cms.
 */
Flight::route('(/[a-z]{2})/cms/@type:[a-z]+/add(/@id:[0-9]+)(/@layout:[a-z]+)', function($type, $id, $layout) {
    if ($layout === null) $layout = 'table';
 	$scaffoldController = new Controller_Scaffold('/cms', $type, $id);
 	$scaffoldController->add($layout);
 });
Flight::route('(/[a-z]{2})/cms/@type:[a-z]+/edit/@id:[0-9]+(/@page:[0-9]+)(/@order:[0-9]+)(/@dir:[0-1]{1})(/@layout:[a-z]+)', function($type, $id, $page, $order, $dir, $layout) {
    if ($layout === null) $layout = 'table';
    if ($page === null) $page = 1;
    if ($order === null) $order = 0;
    if ($dir === null) $dir = 0;
	$scaffoldController = new Controller_Scaffold('/cms', $type, $id);
	$scaffoldController->edit($page, $order, $dir, $layout);
});
Flight::route('(/[a-z]{2})/cms/@type:[a-z]+(/@layout:[a-z]+)(/@page:[0-9]+)(/@order:[0-9]+)(/@dir:[0-1]{1})', function($type, $layout, $page, $order, $dir) {
    if ($layout === null) $layout = 'table';
    if ($page === null) $page = 1;
    if ($order === null) $order = 0;
    if ($dir === null) $dir = 0;
	$scaffoldController = new Controller_Scaffold('/cms', $type);
	$scaffoldController->index($layout, $page, $order, $dir);
});

/**
 * Routes to the language controller.
 */
Flight::route('POST (/[a-z]{2})/language/set', function() {
	$languageController = new Controller_Language();
	$languageController->set();
});

/**
 * Route to the account controller.
 */
Flight::route('(/[a-z]{2})/account', function() {
	$accountController = new Controller_Account();
	$accountController->index();
});
Flight::route('(/[a-z]{2})/account/changepassword', function() {
	$accountController = new Controller_Account();
	$accountController->changepassword();
});
Flight::route('(/[a-z]{2})/account/lostpassword', function() {
	$accountController = new Controller_Account();
	$accountController->lostpassword();
});

/**
 * Route to the install controller.
 */
Flight::route('(/[a-z]{2})/install', function() {
	$installController = new Controller_Install();
	$installController->index();
});

/**
 * Forbidden.
 */
Flight::route('(/[a-z]{2})/forbidden', function() {
    Flight::render('403', array(), 'content');
    Flight::render('html5', array(
        'language' => Flight::get('language'),
        'title' => I18n::__('forbidden_head_title')
    ));
    Flight::stop(403);
});

/**
 * Show a 404 error page if no route has jumped in yet and the url can not be found in domain beans.
 *
 * This is the last resort, all other urls of your domain tree should have been covered by
 * routes before the notFound escape.
 */
Flight::map('notFound', function() {
    $parsed = parse_url(Flight::request()->url);
    if ( Flight::get('language') != Flight::get('default_language') ) {
        $parsed['path'] = str_replace( '/' . Flight::get('language') . '/', '', $parsed['path'] );
    }
    if ($domain = R::findOne('domain', ' url = ? ', array(trim($parsed['path'], '/')))) {
        $cmsController = new Controller_Cms();
    	$cmsController->frontend($domain);
    }
    else
    {
        Flight::render('404', array(), 'content');
        Flight::render('html5', array(
            'language' => Flight::get('language'),
            'title' => I18n::__('notfound_head_title')
        ));
        Flight::stop(404);
    }
});
