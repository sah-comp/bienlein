<?php
/**
 * Cinnebar.
 *
 * My lightweight no-framework framework written in PHP.
 *
 * @package Cinnebar
 * @author $Author$
 * @version $Id$
 */

/**
 * Manages currency.
 *
 * @package Cinnebar
 * @subpackage Model
 * @version $Id$
 */
class Model_Currency extends Model
{
    /**
     * Uses a service of the ECB to load currency exchange rates based on the EUR.
     *
     * For each currency on the exchange rate list a currency bean is looked up and updated by a
     * plain RedBean exec command (to bypass converters and validators). If a currency is not
     * found in the list of currency beans it will be skipped.
     *
     * The ECB has more information {@link http://www.ecb.int/stats/exchange/eurofxref/html/index.en.html}
     *
     * @return bool
     */
    public function loadexchangerates()
    {
        if ( ! Flight::setting()->exchangerateservice) return false;
        if ( ! $xml = simplexml_load_file(Flight::setting()->exchangerateservice)) return false;
        $ret = true;
        foreach ($xml->Cube->Cube->Cube as $rate) {
            // do whatever stuff to store rate | currency into the database.
            // $rate['rate'] = decimal, $rate['currency'] = iso code
            if ( ! $currency = R::findOne('currency', ' iso = ? ', array($rate['currency']))) continue;
            try {
                $sql = 'UPDATE currency SET exchangerate = ? WHERE id = ?';
                R::exec($sql, array($rate['rate'], $currency->getId()));
            } catch (Exception $e) {
                $ret = false;
            }
        }
        return $ret;
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
                'name' => 'iso',
                'sort' => array(
                    'name' => 'currency.iso'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'name',
                'sort' => array(
                    'name' => 'currency.name'
                ),
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'exchangerate',
                'sort' => array(
                    'name' => 'currency.exchangerate'
                ),
                'class' => 'number',
                'filter' => array(
                    'tag' => 'text'
                )
            ),
            array(
                'name' => 'enabled',
                'sort' => array(
                    'name' => 'currency.enabled'
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
     * update.
     *
     * Makes sure that exchangerate will be stored as double.
     */
    public function update()
    {
        $this->bean->setMeta('cast.exchangerate', 'double')->exchangerate = $this->bean->exchangerate;
        parent::update();
    }

    /**
     * Setup validators and set auto info to true.
     */
    public function dispense()
    {
        $this->addValidator('iso', array(
            new Validator_HasValue(),
            new Validator_IsUnique(array('bean' => $this->bean, 'attribute' => 'iso'))
        ));
        $this->addValidator('name', new Validator_HasValue());
        $this->addConverter('exchangerate', new Converter_Decimal());
    }
}
