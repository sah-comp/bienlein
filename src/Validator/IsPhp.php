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
 * IsPhp validator.
 *
 * @uses eval() to find out if given string is valid php code (semantically not logical)
 *
 * @package Cinnebar
 * @subpackage Validator
 * @version $Id$
 */
class Validator_IsPhp extends Validator
{
    /**
     * Returns wether the given string if valid PHP code or not.
     *
     * @param string $value
     * @return bool $validOrInvalid
     */
    public function validate($value)
    {
        return @eval('return true;?>' . $value);
    }
}
