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
 * The database sessionhandler class.
 *
 * This sessionhandler uses the database to keep track of user sessions.
 *
 * @package Cinnebar
 * @subpackage Sessionhandler
 * @version $Id$
 */
class Sessionhandler_Database extends Sessionhandler
{   
	/**
	 * Opens a new session.
	 *
	 * @param string $path
	 * @param string $id
	 * @return bool
	 */
	public function open($path, $id)
    {
        return true;
    }
    
	/**
	 * Closes the session.
	 *
	 * @return bool
	 */
    public function close()
	{
	    return true;
	}
    
	/**
	 * Returns the session data or an empty string.
	 *
	 * @uses R
	 *
	 * @param string $id
	 * @return string
	 */
	public function read($id)
	{
	    if ( ! $session = R::findOne('session', ' token = ?', array($id))) return '';
        return $session->data;
	}
	
	/**
	 * Writes the session to the database.
	 *
	 * @uses R
	 *
	 * @param string $id
	 * @param string $data
	 * @return bool
	 */
    public function write($id, $data)
	{
        if (! $session = R::findOne('session', ' token = ?', array($id))) {
            $session = R::dispense('session');
        }
        $session->token = $id;
        $session->data = $data;
        $session->lastupdate = time();
        try {
            R::store($session);
            return true;
        } catch (Exception $e) {
            return false;
        }
	}

	/**
	 * Deletes the session record from the database.
	 *
	 * @uses R
	 *
	 * @param string $id
	 * @return bool
	 */
    public function destroy($id)
	{
	    if ( ! $session = R::findOne('session', ' token = ?', array($id))) return true;
	    try {
	        R::trash($session);
	        return true;
	    } catch (Exception $e) {
	        return false;
	    }
	}

	/**
	 * Perform garbage collection for outdated sessions.
	 *
	 * @param int $max_lifetime
	 * @return bool
	 */
    public function gc($max_lifetime)
	{
        return true;
	}
}
