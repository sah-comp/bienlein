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
 * News model.
 *
 * @package Cinnebar
 * @subpackage Model
 * @version $Id$
 */
class Model_News extends Model
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
                'name' => 'newscat_id',
                'sort' => array(
                    'name' => 'newscati18n.name'
                ),
                'callback' => array(
                    'name' => 'getLocalizedNewscatName'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'pubdatetime',
                'sort' => array(
                    'name' => 'news.pubdatetime'
                ),
                'callback' => array(
                    'name' => 'localizedDateTime'
                ),
                'filter' => array(
                    'tag' => 'datetime'
                )
            ),
            array(
                'name' => 'name',
                'sort' => array(
                    'name' => 'news.name'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'online',
                'sort' => array(
                    'name' => 'news.online'
                ),
                'callback' => array(
                    'name' => 'boolean'
                ),
                'filter' => array(
                    'tag' => 'bool'
                )
            ),
            array(
                'name' => 'archived',
                'sort' => array(
                    'name' => 'news.archived'
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
     * Returns the name of this beans newscat.
     *
     * @return string
     */
    public function getLocalizedNewscatName()
    {
        return $this->bean->newscat->i18n(Flight::get('user')->getLanguage())->name;
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
		LEFT JOIN newscat ON newscat.id = news.newscat_id
		    LEFT JOIN newscati18n ON newscati18n.newscat_id = newscat.id AND newscati18n.language = '{$language}'
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
     * Returns keywords from this bean for tagging.
     *
     * @var array
     */
    public function keywords()
    {
        return array(
            $this->bean->name
        );
    }
    
    /**
     * Update.
     */
    public function update()
    {
        if ($this->bean->newscat_id) {
            $this->bean->newscat = R::load('newscat', $this->bean->newscat_id);
            $this->bean->newscat->lastmodified = time();
        } else {
            unset($this->bean->newscat);
        }
        parent::update();
    }
    
    /**
     * Dispense.
     */
    public function dispense()
    {
        if (Flight::has('user')) $this->bean->language = Flight::get('user')->getLanguage();
        $this->autoInfo(true);
        $this->autoTag(true);
        $this->bean->pubdatetime = date('Y-m-d H:i:s');
        $this->addConverter('pubdatetime',
            new Converter_Mysqldatetime()
        );
        $this->addValidator('pubdatetime', array(
            new Validator_HasValue()
        ));
        $this->addValidator('name', array(
            new Validator_HasValue()
        ));
        $this->addValidator('teaser', array(
            new Validator_HasValue()
        ));
        $this->addValidator('newscat_id', array(
            new Validator_HasValue()
        ));
    }
}
