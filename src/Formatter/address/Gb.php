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
 * Formats a postal address for united kingdom (gb).
 *
 * See {@link http://www.upu.int/fileadmin/documentsFiles/activities/addressingUnit/gbrEn.pdf} on how
 * a postal address in the united kingdom should be formatted.
 *
 * @package Cinnebar
 * @subpackage Formatter
 * @version $Id$
 */
class Formatter_Address_Gb extends Formatter
{
    /**
     * Formats attributes of a bean.
     *
     * @param RedBeanPHP\OODBBean $bean to format
     * @return string $formattedString
     */
    public function format(RedBeanPHP\OODBBean $bean)
    {
        return sprintf("%s\n%s\n%s\n%s\nUNITED KINGDOM", $bean->street, mb_strtoupper($bean->city), $bean->county, mb_strtoupper($bean->zip));
    }
}
