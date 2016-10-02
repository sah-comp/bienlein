<?php
if ( ! defined('CINNEBAR_TEST_DB_SETUP')) {
    /**
     * RedbeanPHP Version 4.
     */
    require __DIR__ . '/../lib/redbean/rb.php';
    require __DIR__ . '/../lib/redbean/Plugin/Cooker.php';
    R::setup('mysql:host=localhost;dbname=DBNAME', 'UNAME', 'SECRET');
    RedBeanPHP\Plugin\Cooker::enableBeanLoading(true); // to allow compatibility to RB3.3
    R::nuke();
    define('CINNEBAR_TEST_DB_SETUP', true);
}
