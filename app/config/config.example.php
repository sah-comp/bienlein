<?php
/**
 * Cinnebar.
 *
 * @package Cinnebar
 * @subpackage Configuration
 * @author $Author$
 * @version $Id$
 */

/**
 * Add a path to your src directory for autoloading.
 */
Flight::path(__DIR__ . '/../../src');

/**
 * Setup our database.
 */
R::setup('mysql:host=localhost;dbname=DBNAME', 'UNAME', 'SECRET');

/**
 * Allow RedBean Cooker Plugin to load beans for compatibility.
 */
RedBean_Plugin_Cooker::enableBeanLoading(true);

/**
 * Set the path to the default views directory.
 */
Flight::set('flight.views.path', __DIR__ . '/../res/tpl');

/**
 * Set the absolute path to your public directory.
 *
 * Example: http://localhost/path/to/public
 */
Flight::set('full_path', '');

/**
 * Set possible languages.
 */
Flight::set('possible_languages', array('de', 'en'));

/**
 * Set the default language.
 */
Flight::set('language', 'de');
