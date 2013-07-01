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
 * Domain model.
 *
 * @package Cinnebar
 * @subpackage Model
 * @version $Id$
 */
class Model_Domain extends Model
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
                    'name' => 'domain.name'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'url',
                'sort' => array(
                    'name' => 'domain.url'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'sequence',
                'sort' => array(
                    'name' => 'domain.sequence'
                ),
                'class' => 'number',
                'filter' => array(
                    'tag' => 'number'
                )
            ),
            array(
                'name' => 'invisible',
                'sort' => array(
                    'name' => 'domain.invisible'
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
     * Returns an array with page beans.
     *
     * @param string $language
     * @return array
     */
    public function getPages($language)
    {
        return R::find('page', 'domain_id = ? AND language = ? ORDER BY sequence', array(
            $this->bean->getId(),
            $language
        ));
    }
    
    /**
     * Returns the permission bean for the given method name.
     *
     * @param string $method_name
     * @return RedBean_OODBBean $permission
     */
    public function getPermission($method_name)
    {
        if ( ! $permission = R::findOne('permission', ' method = ? AND domain_id = ?', array(
            $method_name,
            $this->bean->getId()
        ))) {
            $permission = R::dispense('permission');
        }
        return $permission;
    }
    
    /**
     * Builds a hierarchical menu from an adjancy bean.
     *
     * @todo get rid of ugly signature
     *
     * @param string (optional) $url_prefix as a kind of basehref, e.g. 'http://localhost/s/de'
     * @param string (optional) $lng code of the language to retrieve
     * @param bool (optional) $invisibles default to false so that invisible beans wont show up
     * @param string (optional) $attr
     * @param string (optional) $orderclause defaults to 'sequence'
     * @return Cinnebar_Menu
     */
    public function hierMenu($url_prefix = '', $lng = null, $invisible = false, $attr = 'url', $order = 'sequence ASC')
    {
        $sql_invisible = 'AND invisible != 1';
        if ($invisible) {
            $sql_invisible = null;
        }
        $sql = sprintf(
            '%s = ? %s ORDER BY %s',
            $this->bean->getMeta('type').'_id',
            $sql_invisible, $order
        );
        $records = R::find(
            $this->bean->getMeta('type'),
            $sql,
            array($this->bean->getId())
        );
        $menu = new Menu();
        foreach ($records as $record) {
            $menu->add(
                $record->i18n($lng)->name,
                Url::build($url_prefix.$record->{$attr}),
                $record->getMeta('type').'-'.$record->getId(),
                $record->hierMenu($url_prefix, $lng, $invisible, $attr, $order)
            );
        }
        return $menu;
    }
    
    /**
     * Update.
     */
    public function update()
    {
        if ($this->bean->domain_id) {
            $this->bean->domain = R::load('domain', $this->bean->domain_id);
        }
        else {
            unset($this->bean->domain);
        }
    }
    
    /**
     * Dispense.
     */
    public function dispense()
    {
        $this->bean->invisible = false;
        //$this->bean->blessed = false;
        $this->bean->sequence = 0;
        $this->addValidator('name', array(
            new Validator_HasValue()
        ));
    }
}
