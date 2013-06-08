<?php
/**
 * sah-comp/any configuration.
 *
 * @package X
 * @author $Author$
 * @version $Id$
 */

//Set the path to the templates
Flight::set('flight.views.path', __DIR__ . '/../res/tpl');

//Set the absolute path to your public folder
Flight::set('full_path', '/any/public');

//Add path to src folder
Flight::path(__DIR__ . '/../../src');
