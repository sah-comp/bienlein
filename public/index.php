<?php
/**
 * sah-comp/any frontcontroller.
 *
 * @package X
 * @author $Author$
 * @version $Id$
 */

//Autoload, configure and load routes
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../app/config/config.php';
require __DIR__ . '/../app/config/routes.php';
// Take off
Flight::start();
