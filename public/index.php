<?php
/**
 * Cinnebar.
 *
 * @package Cinnebar
 * @subpackage System
 * @author $Author$
 * @version $Id$
 */

// Autoload
require __DIR__ . '/../vendor/autoload.php';
// Configure system and Routes
class_alias('RedBean_Facade', 'R');
require __DIR__ . '/../app/config/config.php';
require __DIR__ . '/../app/config/routes.php';
// Take off
Flight::start();
