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
 * Token model.
 *
 * @package Cinnebar
 * @subpackage Model
 * @version $Id$
 */
class Model_Token extends Model
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
                    'name' => 'token.name'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'i18n_name',
                'callback' => array(
                    'name' => 'translated'
                ),
                'sort' => array(
                    'name' => 'i18n.name'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            )
        );
    }
    
    /**
     * Returns the translated token.
     *
     * @return string
     */
    public function translated($attribute = 'name')
    {
        return $this->i18n(Flight::get('language'))->name;
    }
}
