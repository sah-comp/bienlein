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
 * Route the root to our welcome controller.
 */
Flight::route('/', array('Controller_Welcome', 'index'));

/**
 * Change the default language.
 */
Flight::route('(/@lang:[a-z]{2})', function($language) { 
    if (in_array($language, Flight::get('possible_languages'))) {
        // Set language
        Flight::set('language', $language);
        // Continue to next route
        return true;
    }
});

/**
 * Route the root to our welcome controller.
 */
Flight::route('(/[a-z]{2})/', array('Controller_Welcome', 'index'));

/**
 * Route to the system controller.
 */
Flight::route('(/[a-z]{2})/admin(/@section)', array('Controller_Admin', 'index'));

/**
 * Show a 404 error page if no route has jumped in yet.
 */
Flight::map('notFound', function() {
    Flight::render('404', array(), 'content');
    Flight::render('html5', array(
        'title' => I18n::__('notfound_head_title')
    ));
});
