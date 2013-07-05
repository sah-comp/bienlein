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
     * Returns an option bean.
     *
     * @param string $name
     * @return RedBean_OODBBean
     */
    public function getOption($name)
    {
        if ( ! $option = R::findOne('sliceoption', 'slice_id = ? AND name = ?', array($this->bean->getId(), $name)))
        {
            $option = R::dispense('sliceoption');
            $option->name = $name;
            $option->value = null;
        }
        return $option;
    }

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
    
    /**
     * update.
     */
    public function update()
    {
        if ($this->bean->page && $this->bean->page->domain) $this->bean->page->domain->lastmodified = time();
        parent::update();
    }
    
    /**
     * after_update will send page a modified event.
     *
     * @uses Model_Page::wasModified()
     */
    public function after_update()
    {
        //$this->bean->page->wasModified(time());
    }
}
