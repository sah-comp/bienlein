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
 * Module model.
 *
 * @package Cinnebar
 * @subpackage Model
 * @version $Id$
 */
class Model_Module extends Model
{
    /**
     * Constructor.
     *
     * Set actions for list views.
     */
    public function __construct()
    {
        $this->setAction('index', array('idle', 'toggleEnabled', 'expunge'));
    }
    
    /**
     * Toggle the enabled attribute and store the bean.
     *
     * @return void
     */
    public function toggleEnabled()
    {
        $this->bean->enabled = ! $this->bean->enabled;
        R::store($this->bean);
    }

    /**
     * Returns an array with attributes for lists.
     *
     * @param string (optional) $layout
     * @return array
     */
    public function getAttributes($layout = 'table')
    {
        return array(
            array(
                'name' => 'name',
                'sort' => array(
                    'name' => 'module.name'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'enabled',
                'sort' => array(
                    'name' => 'module.enabled'
                ),
                'callback' => array(
                    'name' => 'boolean'
                ),
                'filter' => array(
                    'tag' => 'bool'
                )
            )
        );
    }
    
    /**
     * Dispense.
     */
    public function dispense()
    {
        $this->addValidator('name', array(
            new Validator_HasValue(),
            new Validator_IsUnique(array('bean' => $this->bean, 'attribute' => 'name'))
        ));
    }
    
    /**
     * Update.
     *
     * This will add validators on the fly for frontend and backend if they have values.
     */
    public function update()
    {
        if ($this->bean->frontend) {
            $this->addValidator('frontend', new Validator_IsPhp());
        }
        if ($this->bean->backend) {
            $this->addValidator('backend', new Validator_IsPhp());
        }
        parent::update();
    }
    
    /**
     * After update write frontend and backend tpl as file if neccessary.
     */
    public function after_update()
    {
        if ($this->bean->frontend) {
            $filename = Flight::get('flight.views.path').'/cache/fe'.md5($this->bean->name).'.php';
            file_put_contents($filename, $this->bean->frontend);
        }
        if ($this->bean->backend) {
            $filename = Flight::get('flight.views.path').'/cache/be'.md5($this->bean->name).'.php';
            file_put_contents($filename, $this->bean->backend);
        }
    }
    
    /**
     * After delete clean up the cached frontend and backend template files.
     */
    public function after_delete()
    {
        if (file_exists($filename = Flight::get('flight.views.path') . 
                                    '/cache/fe' . md5($this->bean->name) . '.php')) {
            unlink($filename = Flight::get('flight.views.path') . 
                                '/cache/fe' . md5($this->bean->name) . '.php');
        }
        if (file_exists($filename = Flight::get('flight.views.path') . 
                                    '/cache/be' . md5($this->bean->name) . '.php')) {
            unlink($filename = Flight::get('flight.views.path') . 
                                    '/cache/be' . md5($this->bean->name) . '.php');
        }
    }
}
