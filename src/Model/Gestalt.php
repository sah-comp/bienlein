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
 * Gestalt model.
 *
 * @package Cinnebar
 * @subpackage Model
 * @version $Id$
 */
class Model_Gestalt extends Model
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
                    'name' => 'gestalt.name'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'desc',
                'sort' => array(
                    'name' => 'gestalt.desc'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'enabled',
                'callback' => array(
                    'name' => 'boolean'
                ),
                'sort' => array(
                    'name' => 'gestalt.enabled'
                ),
                'filter' => array(
                    'tag' => 'bool'
                )
            )
        );
    }
    
    /**
     * Returns an array with attributes for a bean from limb beans of this gestalt.
     *
     * @param string (optional) $layout
     * @return array
     */
    public function getVirtualAttributes()
    {
        $ret = array();
        foreach ($this->bean->withCondition(' active = 1 ORDER BY sequence ASC')->ownLimb as $id => $limb) {
            if ($limb->tag == 'subform') continue;
            //standard
            $attribute = array(
                'name' => $limb->name,
                'sort' => array(
                    'name' => $limb->name
                )
            );
            //is it filterable?
            if ($limb->filter) {
                if (in_array($limb->tag, array('checkbox'))) {
                    $tag = 'bool';
                } else {
                    $tag = 'text';
                }
                $attribute['filter'] = array(
                    'tag' => $tag
                );
            }
            //does it need a certain callback?
            if (in_array($limb->tag, array('checkbox'))) {
                $attribute['callback'] = array(
                    'name' => 'boolean'
                );
            }
            $ret[] = $attribute;
        }
        return $ret;
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
     */
    public function update()
    {
		parent::update();
    }
}
