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
 * Manages a user session.
 *
 * To add your own sessionhandler simply add a php file to the sessionhandler directory of your Cinnebar
 * installation. Name the sessionhandler after the scheme Sessionhandler_* extends Cinnebar_Sessionhandler
 * and implement all methods seen here. You can than use it by defining it as your default sessionhandler
 * in your configuration file {@link config.example.php}. As an example see {@link Sessionhandler_Apc}.
 *
 * @package Cinnebar
 * @subpackage Sessionhandler
 * @version $Id$
 */
class Sessionhandler
{   
	/**
	 * opens a new session and returns true.
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
	 * closes the session.
	 *
	 * @return bool
	 */
    public function close()
	{
	    return true;
	}
    
	/**
	 * returns the session data or an empty string.
	 *
	 * @param string $id
	 * @return string
	 */
	public function read($id)
	{
        return '';
	}
	
	/**
	 * writes the session data.
	 *
	 * @param string $id
	 * @param string $data
	 * @return bool
	 */
    public function write($id, $data)
	{
        return true;
	}

	/**
	 * deletes the session.
	 *
	 * @param string $id
	 * @return bool
	 */
    public function destroy($id)
	{
        return true;
	}

	/**
	 * deletes all old and outdated sessions.
	 *
	 * @param int $max_lifetime
	 * @return bool
	 */
    public function gc($max_lifetime)
	{
        return true;
	}
}
