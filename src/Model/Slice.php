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
 * Slice model.
 *
 * @package Cinnebar
 * @subpackage Model
 * @version $Id$
 */
class Model_Slice extends Model
{
    /**
     * Outputs a template based on this slice module.
     *
     * @uses $module
     *
     * @return void
     */
    public function render($template = 'frontend')
    {
        if ( ! $this->bean->module) {
            echo I18n::__('slice_module_not_set');
            return;
        }
        Flight::render("module/{$this->bean->module}/{$template}", array(
            'record' => $this->bean
        ));
    }
    
    /**
     * Dispense.
     */
    public function dispense()
    {
        $this->addValidator('module', new Validator_HasValue());
    }
}
