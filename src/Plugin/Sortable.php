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
 * Updates the sequence of a set of beans after sorting with jQuery.
 *
 * @package Cinnebar
 * @subpackage Plugin
 * @version $Id$
 */
class Plugin_Sortable extends Plugin
{
	/**
	 * Updates all given beans of a certain type after being sorted by client in frontend.
	 *
	 * @param string $type
	 * @param string $varname is the name of the variable the list of sortable items is in
	 * @return void
	 */
	public function execute($type, $varname = 'sequence')
	{
        session_start();
        if ($sequence = Flight::request()->query->$varname) {
            foreach ($sequence as $n => $id) {
                $bean = R::load($type, $id);
                if ( ! $bean->getId()) continue; // skip if that id does not exist
                $bean->sequence = $n;
                R::store($bean);
            }
        }
		return true;
	}
}
