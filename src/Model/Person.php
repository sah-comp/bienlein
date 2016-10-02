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
 * Person model.
 *
 * @package Cinnebar
 * @subpackage Model
 * @version $Id$
 */
class Model_Person extends Model
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
                'name' => 'nickname',
                'sort' => array(
                    'name' => 'person.nickname'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'lastname',
                'sort' => array(
                    'name' => 'person.lastname'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'firstname',
                'sort' => array(
                    'name' => 'person.firstname'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'organization',
                'sort' => array(
                    'name' => 'person.organization'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'email',
                'sort' => array(
                    'name' => 'person.email'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'phone',
                'sort' => array(
                    'name' => 'person.phone'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'enabled',
                'sort' => array(
                    'name' => 'person.enabled'
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
     * Returns an address bean of this person with a given label.
     *
     * @param string $label defaults to 'default'
     * @return RedBeanPHP\OODBBean $address
     */
    public function getAddress($label = 'default')
    {
        return R::findOne('address', 'label = ? AND person_id = ?', array($label, $this->bean->getId()));
    }

    /**
     * Returns keywords from this bean for tagging.
     *
     * @var array
     */
    public function keywords()
    {
        return array(
            $this->bean->email,
            $this->bean->phone,
            $this->bean->fax,
            $this->bean->account,
            $this->bean->vatid,
            $this->bean->firstname,
            $this->bean->lastname,
            $this->bean->organization,
            $this->bean->nickname,
            $this->bean->phoneticfirstname,
            $this->bean->phoneticlastname
        );
    }

    /**
     * Dispense.
     */
    public function dispense()
    {
        $this->autoTag(true);
        $this->addValidator('nickname', array(
            new Validator_HasValue(),
            new Validator_IsUnique(array('bean' => $this->bean, 'attribute' => 'nickname'))
        ));
    }

    /**
     * Update.
     *
     * @todo Implement a switch to decide wether to use first/last or last/first name order
     */
    public function update()
    {
        
        if ($this->bean->email) {
            $this->addValidator('email', array(
                new Validator_IsEmail(),
                new Validator_IsUnique(array('bean' => $this->bean, 'attribute' => 'email'))
            ));
        }
        
		// set the phonetic names
		$this->bean->phoneticlastname = soundex($this->bean->lastname);
		$this->bean->phoneticfirstname = soundex($this->bean->firstname);
		// set the name according to sort rule
		$this->bean->name = implode(' ', array($this->bean->firstname, $this->bean->lastname));
		// company name
		if (trim($this->bean->name) == '' && $this->bean->organization || $this->bean->company) {
			$this->bean->name = $this->bean->organization;
		}
		if (trim($this->bean->name) == '') {
			$this->bean->name = $this->bean->nickname;
		}
		parent::update();
    }
}
