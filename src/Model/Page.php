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
 * Page model.
 *
 * @package Cinnebar
 * @subpackage Model
 * @version $Id$
 */
class Model_Page extends Model
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
                    'name' => 'page.name'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            )
        );
    }
    
    /**
     * Returns slices of this article grouped by region.
     *
     * @param int $region
     * @param string $language iso code of the language
     * @param bool (optional) $add a empty region bean
     * @return array
     */
    public function getSlicesByRegion($region_id, $add = true)
    {
        $slices = R::find('slice', ' page_id = ? AND region_id = ? ORDER BY sequence', array($this->bean->getId(), $region_id));
        if ($add) $slices[] = R::dispense('slice');
        return $slices;
    }

    /**
     * Returns SQL string.
     *
     * @uses Model_User::getLanguage() to retrieve the current users backend language iso code
     *
     * @param string (optional) $fields to select
     * @param string (optional) $where
     * @param string (optional) $order
     * @param int (optional) $offset
     * @param int (optional) $limit
     * @return string $sql
     */
    public function getSql($fields = 'id', $where = '1', $order = null, $offset = null, $limit = null)
    {
        $language = Flight::get('user')->getLanguage();
		$sql = <<<SQL
		SELECT
		    {$fields}
		FROM
		    {$this->bean->getMeta('type')}
		WHERE
		    {$this->bean->getMeta('type')}.language = '{$language}' AND
		    {$where}
SQL;
        //add optional order by
        if ($order) {
            $sql .= " ORDER BY {$order}";
        }
        //add optional limit
        if ($offset || $limit) {
            $sql .= " LIMIT {$offset}, {$limit}";
        }
        return $sql;
    }
    
    /**
     * Update.
     */
    public function update()
    {
        foreach ($this->bean->ownSlice as $id => $slice) {
            if ( ! $slice->module) {
                unset($this->bean->ownSlice[$id]);
            }
        }
        if ($this->bean->domain_id) {
            $this->bean->domain = R::load('domain', $this->bean->domain_id);
        } else {
            unset($this->bean->domain); //clear domain?!
        }
        if ($this->bean->template_id) {
            $this->bean->template = R::load('template', $this->bean->template_id);
        } else {
            unset($this->bean->template); //clear template?!
        }
        parent::update();
    }

    /**
     * Dispense.
     *
     * @uses Model_User::getLanguage() to set the page language to users current language iso code
     */
    public function dispense()
    {
        if (Flight::has('user')) $this->bean->language = Flight::get('user')->getLanguage();
        $this->bean->template = R::findOne('template', 'name = ?', array('default'));
        $this->autoInfo(true);
        $this->addValidator('name', new Validator_HasValue());
        $this->addValidator('language', new Validator_HasValue());
        $this->addValidator('template_id', new Validator_HasValue());
    }
}
