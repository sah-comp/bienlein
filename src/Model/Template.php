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
 * Template model.
 *
 * @package Cinnebar
 * @subpackage Model
 * @version $Id$
 */
class Model_Template extends Model
{
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
                    'name' => 'name'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            )
        );
    }
    
    /**
     * Dispense.
     */
    public function dispense()
    {
        $this->addValidator('name', new Validator_HasValue());
    }
    
    /**
     * After update write frontend and backend tpl as file if neccessary.
     */
    public function after_update()
    {
        if ($this->bean->html) {
            $filename = Flight::get('flight.views.path').'/cache/htm'.md5($this->bean->name).'.php';
            file_put_contents($filename, $this->bean->html);
        }
        if ($this->bean->txt) {
            $filename = Flight::get('flight.views.path').'/cache/txt'.md5($this->bean->name).'.php';
            file_put_contents($filename, $this->bean->txt);
        }
    }
    
    /**
     * After delete clean up the cached frontend and backend template files.
     */
    public function after_delete()
    {
        if (file_exists($filename = Flight::get('flight.views.path') . 
                                    '/cache/htm' . md5($this->bean->name) . '.php')) {
            unlink($filename = Flight::get('flight.views.path') . 
                                '/cache/htm' . md5($this->bean->name) . '.php');
        }
        if (file_exists($filename = Flight::get('flight.views.path') . 
                                    '/cache/txt' . md5($this->bean->name) . '.php')) {
            unlink($filename = Flight::get('flight.views.path') . 
                                    '/cache/txt' . md5($this->bean->name) . '.php');
        }
    }
}
