<?php
if ( ! defined('CINNEBAR_TEST_DB_SETUP')) {
    R::setup('mysql:host=localhost;dbname=DBNAME', 'UNAME', 'SECRET');
    RedBean_Plugin_Cooker::enableBeanLoading(true); // to allow compatibility to RB3.3
    R::nuke();
    define('CINNEBAR_TEST_DB_SETUP', true);
}
