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
 * Numeric validator.
 *
 * @package Cinnebar
 * @subpackage Validator
 * @version $Id$
 */
class Validator_IsNumeric extends Validator
{
    /**
     * Returns wether the value is numeric or not.
     *
     * @param mixed $value
     * @return bool $validOrInvalid
     */
    public function validate($value)
    {
        return (is_numeric($value));
    }
}
