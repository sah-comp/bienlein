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
     * Returns a module bean with the given name.
     *
     * @param string (optional) $module_name defaults to $this->bean->module
     * @return RedBeanPHP\OODBBean $module
     */
    public function getModule($module_name = null)
    {
        if ($module_name === null) $module_name = $this->bean->module;
        if ( ! $module = R::findOne('module', ' name = ?', array($module_name))) {
            $module = R::dispense('module');
        }
        return $module;
    }
    
    /**
     * Returns media beans of this slice.
     *
     * @return array
     */
    public function getMedias()
    {
        return R::find('media', ' slice_id = ? ORDER BY sequence', array($this->bean->getId()));
    }
    
    /**
     * Renders either the static backend tpl or the dynamic one of this slice module.
     *
     * @param string (optional) $container_name defaults to null, just renders the slice
     * @return void
     */
    public function renderBackend($container_name = null)
    {
        $tpl = "module/{$this->bean->module}/backend";
        if ( ! Flight::view()->exists($tpl)) {
            $tpl = 'cache/be'.md5($this->getModule()->name);
        }
        Flight::render($tpl, array(
		    'record' => $this->bean
		), $container_name);
		return;
    }

    /**
     * Renders the slice for frontend view.
     *
     * @param string (optional) $container_name defaults to null, just renders the slice
     * @return void
     */
    public function renderFrontend($container_name = null)
    {
        if ( ! $this->bean->module) {
            echo I18n::__('slice_module_not_set');
            return;
        }
        $tpl = "module/{$this->bean->module}/frontend";
        if ( ! Flight::view()->exists($tpl)) {
            $tpl = 'cache/fe'.md5($this->getModule()->name);
        }
        Flight::render($tpl, array(
            'record' => $this->bean
        ), $container_name);
        return;
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
        if ($this->bean->page && $this->bean->page->domain) 
                                    $this->bean->page->domain->lastmodified = time();
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
