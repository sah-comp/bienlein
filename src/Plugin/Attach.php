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
 * Dispenses a new bean, own(ed) or shared of a master bean and displays its template.
 *
 * @package Cinnebar
 * @subpackage Plugin
 * @version $Id$
 */
class Plugin_Attach extends Plugin
{
	/**
	 * Dispenses a blank Bean as either own or shared and outputs the template.
	 *
	 * @param string $prefix
	 * @param string $type
	 * @param mixed (optional) $id
	 * @return void
	 */
	public function execute($prefix, $type, $id = 0)
	{
        session_start();        
		$n = md5(microtime(true));
        $record = R::dispense($type);
        echo 'Attach a record';
	}
}
