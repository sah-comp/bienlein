<?php
/**
 * Cinnebar.
 *
 * @package Cinnebar
 * @subpackage Model
 * @author $Author$
 * @version $Id$
 */

/**
 * Email model.
 *
 * @package Cinnebar
 * @subpackage Model
 * @version $Id$
 */
class Model_Email extends Model
{
    /**
     * Dispense.
     */
    public function dispense()
    {
        $this->addValidator('value', new Validator_IsEmail());
    }
}
