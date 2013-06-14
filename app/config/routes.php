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
Flight::route('(/[a-z]{2})/', array('Controller_Welcome', 'index'));

/**
 * Route to the install controller.
 */
Flight::route('(/[a-z]{2})/install', array('Controller_Install', 'index'));

/**
 * Route to the login/logout controllers.
 */
Flight::route('(/[a-z]{2})/login', array('Controller_Login', 'index'));
Flight::route('(/[a-z]{2})/logout', array('Controller_Logout', 'index'));

/**
 * Route to the admin controller.
 */
Flight::route('(/[a-z]{2})/admin/user', array('Controller_Admin', 'user'));
Flight::route('(/[a-z]{2})/admin(/*)', array('Controller_Admin', 'index'));

/**
 * Catch all before notFound.
 *
 * @todo Lets go through our CMS later on
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
