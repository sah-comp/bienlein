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
 * The APC(Another PHP Cache) sessionhandler class.
 *
 * This sessionhandler uses an installed APC extension to handle user sessions. 
 *
 * @package Cinnebar
 * @subpackage Sessionhandler
 * @version $Id$
 */
class Sessionhandler_Apc extends Sessionhandler
{
    /**
     * Holds a (optional) prefix to keep APC user cache land tidy.
     *
     * @var string
     */
    public $prefix = 'CINNEBAR_SESS_';

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
	 * @param string $id
	 * @return string
	 */
	public function read($id)
	{
        if ( false == $session = apc_fetch($this->prefix.$id)) return '';
        return $session;
	}
	
	/**
	 * Writes the session to APC user values.
	 *
	 * @param string $id
	 * @param string $data
	 * @return bool
	 */
    public function write($id, $data)
	{
        return apc_store($this->prefix.$id, $data);
	}

	/**
	 * Deletes the session record from APC user values.
	 *
	 * @param string $id
	 * @return bool
	 */
    public function destroy($id)
	{
        return apc_delete($this->prefix.$id);
	}

	/**
	 * Perform a garbage collection for outdated sessions.
	 *
	 * @param int $max_lifetime
	 * @return bool
	 */
    public function gc($max_lifetime)
	{
        return true;
	}
}
