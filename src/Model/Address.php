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
 * Address model.
 *
 * @package Cinnebar
 * @subpackage Model
 * @version $Id$
 */
class Model_Address extends Model
{
    /**
     * Returns an array with label names.
     *
     * @return array
     */
    public function getLabels()
    {
        return array(
            'default',
            'delivery',
            'billing',
            'private',
            'other'
        );
    }

    /**
	 * update.
	 *
	 * @uses formatAddress() to format the postal address depending on the country code
	 */
	public function update()
	{
	    if ( $this->bean->country_id) {
	        $this->bean->country = R::load('country', $this->bean->country_id);
	    } else {
	        unset($this->bean->country);
	    }
        $this->bean->formattedaddress = $this->getFormattedAddress();
        parent::update();
	}
    
    /**
	 * Returns a formatted address based on the country of the address.
	 *
	 * The formmatter to be used is determined by the country code (iso) of this postal address.
	 * If no address formatter with the given country code can be found the address is formatted
	 * as if it was a german post office address.
	 *
	 * @return string $stringWithFormattedPostalAddress
	 */
	public function getFormattedAddress()
	{
	    if ( ! $this->bean->country) return I18n::__('address_formattedaddress_error_no_country');
		$formatter_name = 'Formatter_Address_'.strtoupper($this->bean->country->iso);
        if ( ! class_exists($formatter_name, true)) {
            return sprintf("%s\n%s %s\n%s\n%s", $this->bean->street, $this->bean->zip, $this->bean->city, $this->bean->county,  $this->bean->country->name);
        }
        $formatter = new $formatter_name();
        return $formatter->format($this->bean);
	}
}
