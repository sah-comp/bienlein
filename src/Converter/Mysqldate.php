<?php
/**
 * Cinnebar.
 *
 * @package Cinnebar
 * @subpackage Converter
 * @author $Author$
 * @version $Id$
 */

/**
 * MySQL Date converter.
 *
 * @package Cinnebar
 * @subpackage Converter
 * @version $Id$
 */
class Converter_Mysqldate extends Converter
{
    /**
     * Returns the value as a mysql date value.
     *
     * @param mixed $value
     * @return string $mySQLDateValue
     */
    public function convert($value)
    {
        if ( ! $value || empty($value) || $value == '0000-00-00') return '0000-00-00';
        return date('Y-m-d', strtotime($value));
    }
}
