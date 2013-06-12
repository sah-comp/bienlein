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
 * Validates a value against a validation rule.
 *
 * To add your own validator simply add a php file to the validator directory of your Cinnebar
 * installation. Name the validator after the scheme Validator_* extends Validator and
 * implement a validate() method. As an example see {@link Validator_Range}.
 *
 * Example usage of the range validator:
 * <code>
 * <?php
 * $range = new Validator_Range(array('min' => 1, 'max' => 100));
 * if ($range->validate(77)) echo '1 >= 77 <= 100 is true';
 * if ($range->validate(177)) echo '1 >= 177 <= 100 is false';
 * ?>
 * </code>
 *
 * @package Cinnebar
 * @subpackage Validator
 * @version $Id$
 */
class Validator
{
    /**
     * Container for the validators options.
     *
     * @var array
     */
    public $options = array();

    /**
     * Constructor.
     *
     * @uses Cinnebar_Validator::$options
     * @param array (optional) $options
     */
    public function __construct(array $options = array()) {
        $this->options = $options;
    }

    /**
     * Returns wether the validation was good or not.
     *
     * This validator checks if the given value is true or not.
     *
     * @param mixed $value
     * @return bool $validOrInvalid
     */
    public function validate($value)
    {
        return $value;
    }
}
