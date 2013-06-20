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
 * Notification model.
 *
 * @package Cinnebar
 * @subpackage Model
 * @version $Id$
 */
class Model_Notification extends Model
{
    /**
     * Update.
     */
    public function update()
    {
        if ( ! $this->bean->getId()) {
            $this->bean->stamp = time();
            $this->bean->read = false;
        }
        parent::update();
    }
}
