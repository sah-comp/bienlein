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
	 * Returns true if the session is authenticated or false if not.
	 *
	 * In case the session is validated, the current user bean is mapped
	 * to Flight.
	 *
	 * @uses Flight::map() to map a user bean in case a validate one is found
	 * @return bool
	 */
    static public function validate()
    {
        if (isset($_SESSION['user']['id'])) {
			Flight::set('user', R::load('user', $_SESSION['user']['id']));
            return true;
        }
		return false;
	}
}
