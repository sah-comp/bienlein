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
 * Phone model.
 *
 * @package Cinnebar
 * @subpackage Model
 * @version $Id$
 */
class Model_Phone extends Model
{
    /**
     * Dispense.
     */
    public function dispense()
    {
        $this->addValidator('value', new Validator_HasValue());
    }
}
