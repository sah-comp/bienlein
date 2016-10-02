<?php
/**
 * Cinnebar.
 *
 * @package Cinnebar
 * @subpackage System
 * @author $Author$
 * @version $Id$
 */

/**
 * RedbeanPHP Version 4.
 */
require __DIR__ . '/../lib/redbean/rb.php';
require __DIR__ . '/../lib/redbean/Plugin/Cooker.php';

/**
 * Autoloader.
 */
require __DIR__ . '/../vendor/autoload.php';

/**
 * Configuration.
 */
require __DIR__ . '/../app/config/config.php';
 
/**
 * Check if this was called from the command line.
 */
if (php_sapi_name() == 'cli' && isset($_SERVER['argc']) && $_SERVER['argc'] >= 1) {
    chdir(dirname(__FILE__));
    $command = new Command_Welcome();
    $command->run();
    exit(1);
}

/**
 * Routes
 */
require __DIR__ . '/../app/config/routes.php';

/**
 * Up, up and away.
 */
Flight::start();
