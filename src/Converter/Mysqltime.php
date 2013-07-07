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
 * MySQL time converter.
 *
 * @package Cinnebar
 * @subpackage Converter
 * @version $Id$
 */
class Converter_Mysqltime extends Converter
{
    /**
     * Returns the value as a mysql time value.
     *
     * @param mixed $value
     * @return string $mySQLTimeValue
     */
    public function convert($value)
    {
        if ( ! $value || empty($value) || $value == '00:00:00') return '00:00:00';
        return date('H:i:s', strtotime($value));
    }
}
