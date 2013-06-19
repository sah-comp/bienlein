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
Flight::route('(/@language:[a-z]{2})(/*)', function($language) {
    if (in_array($language, Flight::get('possible_languages'))) {
        Flight::set('language', $language);
    }
    return true;
});

/**
 * Route the root to our welcome controller.
 */
Flight::route('(/[a-z]{2})/', function() {
	$welcomeController = new Controller_Welcome();
	$welcomeController->index();
});

/**
 * Route to the install controller.
 */
Flight::route('(/[a-z]{2})/install', function() {
	$installController = new Controller_Install();
	$installController->index();
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
 * Routes to the scaffold controller.
 */
 Flight::route('(/[a-z]{2})/admin/@type:[a-z]+/add(/@id:[0-9]+)', function($type, $id) {
 	$scaffoldController = new Controller_Scaffold('/admin', $type, $id);
 	$scaffoldController->add();
 });
Flight::route('(/[a-z]{2})/admin/@type:[a-z]+/edit/@id:[0-9]+(/@page:[0-9]+)(/@order:[0-9]+)(/@dir:[0-1]{1})', function($type, $id, $page, $order, $dir) {
    if ($page === null) $page = 1;
    if ($order === null) $order = 0;
    if ($dir === null) $dir = 0;
	$scaffoldController = new Controller_Scaffold('/admin', $type, $id);
	$scaffoldController->edit($page, $order, $dir);
});
Flight::route('(/[a-z]{2})/admin/@type:[a-z]+/delete/@id:[0-9]+', function($type, $id) {
	$scaffoldController = new Controller_Scaffold('/admin', $type, $id);
	$scaffoldController->delete();
});
Flight::route('(/[a-z]{2})/admin/@type:[a-z]+(/@layout:[a-z]+)(/@page:[0-9]+)(/@order:[0-9]+)(/@dir:[0-1]{1})', function($type, $layout, $page, $order, $dir) {
    if ($layout === null) $layout = 'table';
    if ($page === null) $page = 1;
    if ($order === null) $order = 0;
    if ($dir === null) $dir = 0;
	$scaffoldController = new Controller_Scaffold('/admin', $type);
	$scaffoldController->index($layout, $page, $order, $dir);
});

/**
 * Routes to the admin controller.
 */
Flight::route('(/[a-z]{2})/admin(/index)', function() {
	$adminController = new Controller_Admin();
	$adminController->index();
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
});

/**
 * Catch all before notFound.
 *
 * @todo Lets go through our CMS (Frontend) controller later on to check that URL
 */
Flight::route('(/[a-z]{2})(/*)', function() {
    Flight::render('404', array(), 'content');
    Flight::render('html5', array(
        'language' => Flight::get('language'),
        'title' => I18n::__('notfound_head_title')
    ));
});

/**
 * Show a 404 error page if no route has jumped in yet.
 */
Flight::map('notFound', function() {
    Flight::render('404', array(), 'content');
    Flight::render('html5', array(
        'language' => Flight::get('language'),
        'title' => I18n::__('notfound_head_title')
    ));
});
