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
 * Converter to turn a locale input value into a decimal value.
 *
 * @package Cinnebar
 * @subpackage Converter
 * @version $Id$
 */
class Converter_Decimal extends Converter
{
    /**
     * Replaces comma against a decimal point and casts the value as float.
     *
     * @param mixed $value
     * @return float $floatingPointValue
     */
    public function convert($value)
    {
        return (float)str_replace(',', '.', $value);
    }
}
