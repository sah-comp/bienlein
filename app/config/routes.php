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
 * @todo maybe set language bean to have locale and so on?
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
Flight::route('(/[a-z]{2})/admin/@type:[a-z]+/edit/@id:[0-9]+', function($type, $id) {
	$scaffoldController = new Controller_Scaffold();
	$scaffoldController->edit($type, $id);
});
Flight::route('(/[a-z]{2})/admin/@type:[a-z]+/add(/@id:[0-9]+)', function($type, $id) {
	$scaffoldController = new Controller_Scaffold();
	$scaffoldController->add($type, $id);
});
Flight::route('(/[a-z]{2})/admin/@type:[a-z]+(/index)', function($type) {
	$scaffoldController = new Controller_Scaffold();
	$scaffoldController->index($type);
});

/**
 * Routes to the admin controller.
 */
Flight::route('(/[a-z]{2})/admin(/index)', function() {
	$adminController = new Controller_Admin();
	$adminController->index();
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
