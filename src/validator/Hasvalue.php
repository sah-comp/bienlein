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
 * HasValue validator.
 *
 * @package Cinnebar
 * @subpackage Validator
 * @version $Id$
 */
class Validator_HasValue extends Validator
{
    /**
     * Returns wether a value has a piece or information or not.
     *
     * @param mixed $value
     * @return bool $hasValueOrNot
     */
    public function validate($value)
    {
        if (null === $value) return false;
        if (empty($value)) return false;
        return true;
    }
}
