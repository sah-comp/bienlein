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
 * IsUnique validator.
 *
 * @package Cinnebar
 * @subpackage Validator
 * @version $Id$
 */
class Validator_IsUnique extends Validator
{
    /**
     * Checks if the value of a beans attribute exists only once in the database.
     *
     * @param mixed $value
     * @return bool $validOrInvalid
     */
    public function validate($value)
    {
        if ( ! isset($this->options['bean']) || ! isset($this->options['attribute']) || ! is_a($this->options['bean'], 'RedBeanPHP\OODBBean')) {
            throw new Exception('A unique validator needs bean and attribute as parameters');
        }
        if ( $this->options['bean']->getId() &&
                ! $this->options['bean']->hasChanged($this->options['attribute'])) {
            return true;
        }
        if (R::findOne($this->options['bean']->getMeta('type'), $this->options['attribute'].' = ?', array($value))) return false; // ... because you are not allowed to store it a second time
        return true;
    }
}
