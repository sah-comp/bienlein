<?php
/**
 * Cinnebar.
 *
 * @package Cinnebar
 * @subpackage Validator
 * @author $Author$
 * @version $Id$
 */

/**
 * IsEmail validator.
 *
 * @package Cinnebar
 * @subpackage Validator
 * @version $Id$
 */
class Validator_IsEmail extends Validator
{
    /**
     * Returns wether the value is a valid email address or not.
     *
     * @param mixed $value
     * @return bool $validOrInvalid
     */
    public function validate($value)
    {
        if (false === filter_var($value, FILTER_VALIDATE_EMAIL)) return false;
        return true;
    }
}
