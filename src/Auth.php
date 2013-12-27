<?php
/**
 * Cinnebar.
 *
 * @package Cinnebar
 * @subpackage Controller
 * @author $Author$
 * @version $Id$
 */

/**
 * Authentication Manager.
 *
 * @package Cinnebar
 * @subpackage Auth
 * @version $Id$
 */
class Auth extends Controller
{
    /**
     * 
     */
    /**
     * Checks for a valid session.
     *
     * @todo implement some serious authentication check
     *
     * If no valid session is found client will be redirected to the login page
     * with the current URL as a query parameter in $goto.
     *
     * A session must already be started.
     */
    static public function check()
    {
		if (self::validate()) return true;
        self::redirect('/login/?goto='.urlencode(Flight::request()->url));
    }

	/**
	 * Returns true if the session is authenticated and not overdue maximum lifetime.
	 *
	 * In case the session is validated, the current user bean is set.
     * If the user account was banned or deleted in the meantime, the session
     * will no longer be validated.
	 *
	 * @uses Flight::set()
	 * @uses alive()
	 * @return bool
	 */
    static public function validate()
    {
        if (isset($_SESSION['user']['id'])) {
			Flight::set('user', R::load('user', $_SESSION['user']['id']));
			if (Flight::get('user')->isBanned() || Flight::get('user')->isDeleted()) return false;
            return self::alive(Flight::get('user')->maxLifetime());
        }
		return false;
	}
	
	/**
	 * Returns wether the maximum session lifetime is over or not.
	 *
     * @param int max_lifetime is the time in seconds, e.g. 14400 are 4 hours
	 * @return bool
	 */
	static public function alive($max_lifetime = MAX_SESSION_LIFETIME)
	{
	    if (isset($_SESSION['ping']) && (time() - $_SESSION['ping'] > $max_lifetime)) {
            session_unset();
            session_destroy();
            return false;
        }
        $_SESSION['ping'] = time();
        return true;
	}
}
