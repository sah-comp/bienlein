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
 * Filter model.
 *
 * @package Cinnebar
 * @subpackage Model
 * @version $Id$
 */
class Model_Filter extends Model
{
    /**
     * Container for values that are collected on building a where clause.
     *
     * @var array
     */
    public $filter_values = array();

    /**
     * Returns a SQL WHERE clause for usage with another bean.
     *
     * @uses Model_Criteria::makeWherePart() to generate the SQL for a criteria
     * @return string $WhereClauseForSQL
     */
    public function buildWhereClause()
    {
        $criterias = $this->bean->ownCriteria;
        if (empty($criterias)) {
            return '1';
        }// find all because there are no criterias
        $where = array();
        $this->filter_values = array();
        //$mask = " %s %s %s"; // login, field, op (with masked value)
        $n = 0;
        foreach ($criterias as $id=>$criteria) {
            if (! $criteria->op) {
                continue;
            } // skip all entries that say any!
            if ($criteria->value === null || $criteria->value === '') {
                continue;
            } // skip all empty
            $n++;
            $logic = 'AND ';//$criteria->logic;
            if ($n == 1) {
                $logic = '';
            }
            $where[] = $logic.$criteria->makeWherePart($this);
        }

        if (empty($where)) {
            return '1';
        }// find all because there was no active criteria

        $where = implode(' ', $where);
        return $where;
    }

    /**
     * Returns an array with values that were collected as the where clause was build.
     *
     * @return array
     */
    public function getFilterValues()
    {
        return $this->filter_values;
    }

    /**
     * Returns a criteria bean for a certain filter attribute.
     *
     * @param array $attribute
     * @return RedBeanPHP\OODBBean
     */
    public function getCriteria(array $attribute)
    {
        if (! $criteria = R::findOne('criteria', ' filter_id = ? AND attribute = ?', array($this->bean->getId(), $attribute['sort']['name']))) {
            $criteria = R::dispense('criteria');
            $criteria->tag = $attribute['filter']['tag'];
            $criteria->attribute = $attribute['sort']['name'];
            $operators = $criteria->operators();
            $criteria->op = $operators[0];
        }
        return $criteria;
    }

    /**
     * Setup validators and set auto info to true.
     */
    public function dispense()
    {
        $this->addValidator('model', new Validator_HasValue());
    }
}
