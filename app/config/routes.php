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
 * Change the default language.
 *
 * @todo I expected Flight::route('(/@language:[a-z]{2})(/*)'), function($language) {}) to work?!
 */
Flight::route('(/@language:[a-z]{2})(/[0-9a-z]+)(/[0-9a-z]+)', function($language) {
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
 * Route to the system controller.
 */
Flight::route('(/[a-z]{2})/admin', array('Controller_Admin', 'index'));
Flight::route('(/[a-z]{2})/admin/user', array('Controller_Admin', 'user'));

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
