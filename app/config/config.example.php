<?php
/**
 * Cinnebar.
 *
 * Define Cinnebar constants according to your server and settings.
 *
 * @package Cinnebar
 * @subpackage Configuration
 * @author $Author$
 * @version $Id$
 */

/**
 * Define database settings.
 */
define('CINNEBAR_DB_HOST', 'localhost');
define('CINNEBAR_DB_NAME', 'DB0815');
define('CINNEBAR_DB_USER', 'root');
define('CINNEBAR_DB_PASSWORD', 'secret');
define('CINNEBAR_DB_FREEZE_FLAG', true);

/**
 * Define default language code.
 */
define('CINNEBAR_DEFAULT_LANGUAGE', 'de');

/**
 * Define the date time zone.
 */
define('CINNEBAR_DATE_TIMEZONE', 'Europe/Berlin');

/**
 * Define templates for localization.
 */
define('CINNEBAR_TEMPLATE_DATE', '%x');
define('CINNEBAR_TEMPLATE_TIME', '%X');
define('CINNEBAR_TEMPLATE_DATETIME', '%x %X');

/**
 * Define the maximum upload size in bytes.
 */
define('CINNEBAR_MAX_UPLOAD_SIZE', 4194304);

/**
 * Define install password.
 */
define('CINNEBAR_INSTALL_PASSWORD', 'Supersecret');

/**
 * Define the setting bean ID.
 */
define('CINNEBAR_SETTING_BEAN_ID', 1);

/**
 * Define internal encoding.
 */
define('CINNEBAR_INTERNAL_ENCODING', 'UTF-8');

/**
 * Define max session life time in seconds.
 *
 * The session lifetime of a user can be set for each user account,
 * but if not set, this will be the maximum session lifetime in seconds.
 */
define('CINNEBAR_MAX_SESSION_LIFETIME', 3600);

/**
 * Set the session cookie name.
 *
 * If you have changed session parameter or handling in a new release change
 * the session name to ensure that older sessions are no longer used.
 */
define('CINNEBAR_SESSION_COOKIE_NAME', 'CINNEBARv1');
