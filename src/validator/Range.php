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
 * Range validator.
 *
 * @package Cinnebar
 * @subpackage Validator
 * @version $Id$
 */
class Validator_Range extends Validator
{
    /**
     * Returns wether the value is in the given range or not.
     *
     * @uses Cinnebar_Validator::$options
     * @param mixed $value
     * @return bool $validOrInvalid
     */
    public function validate($value)
    {
        if ( ! isset($this->options['min']) || ! isset($this->options['max'])) {
            throw new Exception('exception_validator_range_has_no_min_or_max');
        }
        return ($value >= $this->options['min'] && $value <= $this->options['max']);
    }
}
