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
 * Limb model.
 *
 * A Limb belongs to Limb and defines the kind of an attribute or relation.
 *
 * @package Cinnebar
 * @subpackage Model
 * @version $Id$
 */
class Model_Limb extends Model
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
                    'name' => 'limb.name'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            )
        );
    }
    
    /**
     * Returns an array of possible kind values.
     *
     * @return array
     */
    public function getKinds()
    {
        return array(
            'attribute',
            'own',
            'shared',
            'link',
            'alias'
        );
    }
    
    /**
     * Returns an array of possible tags.
     *
     * @return array
     */
    public function getTags()
    {
        return array(
            'text',
            'number',
            'textarea',
            'checkbox',
            'subform',
            'password'
        );
    }

    /**
     * Returns keywords from this bean for tagging.
     *
     * @var array
     */
    public function keywords()
    {
        return array(
        );
    }
    
    /**
     * Renders a limb together with a bean.
     *
     * @param RedBeanPHP\OODBBean $record
     * @return void
     */
    public function render(RedBeanPHP\OODBBean $record)
    {
        Flight::render(sprintf('model/limb/tag/%s', $this->bean->tag), array(
            'record' => $record,
            'limb'  => $this->bean
        ));
    }
    
    /**
     * Render a 
     */

    /**
     * Dispense.
     */
    public function dispense()
    {
        $this->addValidator('name', array(
            new Validator_HasValue()
        ));
    }

    /**
     * Update.
     */
    public function update()
    {
		parent::update();
    }
}
