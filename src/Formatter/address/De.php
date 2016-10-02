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
 * Formats a german postal address.
 *
 * See {@link http://www.upu.int/fileadmin/documentsFiles/activities/addressingUnit/deuEn.pdf} on how
 * a german postal address should be formatted.
 *
 * @package Cinnebar
 * @subpackage Formatter
 * @version $Id$
 */
class Formatter_Address_De extends Formatter
{
    /**
     * Formats attributes of a bean.
     *
     * @param RedBeanPHP\OODBBean $bean to format
     * @return string $formattedString
     */
    public function format(RedBeanPHP\OODBBean $bean)
    {
        return sprintf("%s\n%s %s\n%s", $bean->street, $bean->zip, $bean->city, 'GERMANY');
    }
}
