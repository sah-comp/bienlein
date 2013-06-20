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
 * Validator to check if a value is a valid date.
 *
 * @package Cinnebar
 * @subpackage Validator
 * @version $Id$
 */
class Validator_IsDate extends Validator
{
    /**
     * Returns wether the value is a valid date or not.
     *
     * @param mixed $value
     * @return bool $validOrInvalid
     */
    public function validate($value)
    {
        if (preg_match("/^(\d{4})-(\d{2})-(\d{2})$/", $value, $matches)) {
            if (checkdate($matches[2], $matches[3], $matches[1])) return true;
        }
        return false;
    }
}
