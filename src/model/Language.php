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
 * Language model.
 *
 * @package Cinnebar
 * @subpackage Model
 * @version $Id$
 */
class Model_Language extends Model
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
                'name' => 'iso',
                'sort' => array(
                    'name' => 'language.iso'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
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
        $this->addValidator('iso', array(
            new Validator_HasValue(),
            new Validator_IsUnique(array('bean' => $this->bean, 'attribute' => 'iso'))
        ));
        $this->addValidator('name', array(
            new Validator_HasValue(),
            new Validator_IsUnique(array('bean' => $this->bean, 'attribute' => 'name'))
        ));
    }
}
