<?php
/**
 * Cinnebar.
 *
 * My lightweight no-framework framework written in PHP.
 *
 * @package Cinnebar
 * @author $Author$
 * @version $Id$
 */

/**
 * The basic formatter class of the cinnebar system.
 *
 * @package Cinnebar
 * @subpackage Formatter
 * @version $Id$
 */
class Formatter
{
    /**
     * Returns a formatted string composed of a bean.
     *
     * @param RedBeanPHP\OODBBean $bean to format
     * @return string $formattedString
     */
    public function format(RedBeanPHP\OODBBean $bean)
    {
        return 'My formatted bean';
    }
}