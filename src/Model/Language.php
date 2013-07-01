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
                    'name' => 'language.name'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'enabled',
                'sort' => array(
                    'name' => 'language.enabled'
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
     * Returns an array with iso codes of enabled languages.
     *
     * @param string (optional) $default_language
     * @return array
     */
    public function getEnabled($default_language = 'de')
    {
        $langs = R::getCol('SELECT iso FROM language WHERE enabled = ? AND iso != ?', array(
            true, $default_language
        ));
        $langs[] = $default_language;
        return $langs;
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
